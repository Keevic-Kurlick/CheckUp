<?php

namespace App\Http\Controllers\Menu\OrderServices;

use App\Http\Controllers\Menu\OrderServices\Exceptions\OrderServiceErrorCreatingException;
use App\Http\Controllers\Menu\OrderServices\Exceptions\ServiceWasNotFoundException;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderInformation;
use App\Repositories\Menu\ServiceRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderServicesManager
{
    /** @var string */
    private const SCAN_NAME_PASSPORT = 'passport_scan';

    /** @var string */
    private const SCAN_NAME_ANALYSIS = 'analysis_scan';

    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(
        private ServiceRepository $serviceRepository
    ) {}

    /**
     * @param CreateOrderRequest $request
     * @param int $serviceId
     * @return void
     * @throws ServiceWasNotFoundException
     */
    public function makeOrderByService(CreateOrderRequest $request, int $serviceId)
    {
        $service = $this->serviceRepository->getServiceToMakeOrderById($serviceId);

        if (empty($service)) {
            throw new ServiceWasNotFoundException('The service was not found.');
        }

        $currentPatient = Auth::user();

        $passportSeries         = $request->passport_series;
        $passportNumber         = $request->passport_number;
        $patientInn             = $request->patient_inn;
        $patientSnils           = $request->patient_snils;
        $patientPassportScan    = $request->file('patient_passport_scan');
        $patientAnalysisScan    = $request->file('patient_analysis_scan');

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->status = Order::AWAIT_STATUS;
            $order->patient_id = $currentPatient->id;
            $order->service_id = $serviceId;
            $order->save();

            $pathToSaveScans = $this->getPathToSaveScans($order->id);

            $fullPathToPassport = $pathToSaveScans
                . $this->getFullScanName($patientPassportScan, self::SCAN_NAME_PASSPORT);

            $fullPathToAnalysis = $pathToSaveScans
                . $this->getFullScanName($patientPassportScan, self::SCAN_NAME_ANALYSIS);

            $this->storePassportScan($patientPassportScan, $pathToSaveScans);
            $this->storeAnalysisScan($patientAnalysisScan, $pathToSaveScans);

            $publicDirPassportScan    = $this->copyScanToPublic($pathToSaveScans, $fullPathToPassport);
            $publicDirAnalysisScan    = $this->copyScanToPublic($pathToSaveScans, $fullPathToAnalysis);

            $orderInformation = new OrderInformation();
            $orderInformation->passport_series = $passportSeries;
            $orderInformation->passport_number = $passportNumber;
            $orderInformation->inn = $patientInn;
            $orderInformation->snils = $patientSnils;
            $orderInformation->passport_path = $publicDirPassportScan;
            $orderInformation->analysis_path = $publicDirAnalysisScan;
            $orderInformation->order_id = $order->id;
            $orderInformation->save();

            $order->update([
                'orderInfo_id' => $orderInformation->id,
            ]);

            DB::commit();

        } catch(\Exception $e) {

            DB::rollBack();

            if (!empty($pathToSaveScans)) {
                $this->rollbackPassportScan($patientPassportScan, $pathToSaveScans);
                $this->rollbackAnalysisScan($patientAnalysisScan, $pathToSaveScans);
                $this->rollbackOrderDirectory($order->id);
            }

            \Log::info('app.Http.Controllers.Menu.OrderServices.OrderServicesManager.makeOrderByService', [
                'message'   => 'An error occurred while creating the order',
                'data'      => [
                    'error_message' => $e->getMessage(),
                    'order_id'      => $order?->id ?? false,
                    'patient_id'    => $currentPatient->id,
                ],
            ]);

            throw new OrderServiceErrorCreatingException('Error creating order');
        }
    }

    /**
     * @param UploadedFile $passportScan
     * @param string $pathToSaveScan
     * @return bool
     */
    private function storePassportScan(UploadedFile $passportScan, string $pathToSaveScan): bool
    {
        $scanName = self::SCAN_NAME_PASSPORT;
        $isPassportScanStored = $this->storeScan($passportScan, $pathToSaveScan, $scanName);

        return $isPassportScanStored;
    }

    /**
     * @param UploadedFile $analysisScan
     * @param string $pathToSaveScan
     * @return bool
     */
    private function storeAnalysisScan(UploadedFile $analysisScan, string $pathToSaveScan): bool
    {
        $scanName = self::SCAN_NAME_ANALYSIS;
        $isAnalysisScanStored = $this->storeScan($analysisScan, $pathToSaveScan, $scanName);

        return $isAnalysisScanStored;
    }

    /**
     * @param UploadedFile $scan
     * @param string $pathToSaveScan
     * @param string $scanName
     * @return bool
     */
    private function storeScan(UploadedFile $scan, string $pathToSaveScan, string $scanName): bool
    {
        $scanNameWithExtension = $this->getFullScanName($scan, $scanName);
        $isScanSaved = (bool) $scan->storeAs($pathToSaveScan, $scanNameWithExtension);

        return $isScanSaved;
    }

    /**
     * @param int $orderId
     * @return bool
     */
    private function rollbackOrderDirectory(int $orderId): bool
    {
        $isOrderDirectoryDeleted = false;
        $orderDirectory = $this->getPathToOrderStorage($orderId);
        $isOrderDirectoryExist = Storage::exists($orderDirectory);

        if ($isOrderDirectoryExist) {
            $isOrderDirectoryDeleted = Storage::deleteDirectory($orderDirectory);
        }

        return $isOrderDirectoryDeleted;
    }

    /**
     * @param UploadedFile $scan
     * @param string $pathToSaveScan
     * @return bool
     */
    private function rollbackPassportScan(UploadedFile $scan, string $pathToSaveScan): bool
    {
        $scanName = self::SCAN_NAME_PASSPORT;
        $isScanRollback = $this->rollbackScan($scan, $pathToSaveScan, $scanName);

        return $isScanRollback;
    }

    /**
     * @param UploadedFile $scan
     * @param string $pathToSaveScan
     * @return bool
     */
    private function rollbackAnalysisScan(UploadedFile $scan, string $pathToSaveScan): bool
    {
        $scanName = self::SCAN_NAME_ANALYSIS;
        $isScanRollback = $this->rollbackScan($scan, $pathToSaveScan, $scanName);

        return $isScanRollback;
    }

    /**
     * @param UploadedFile $scan
     * @param string $pathToSaveScan
     * @param string $scanName
     * @return bool
     */
    private function rollbackScan(UploadedFile $scan, string $pathToSaveScan, string $scanName): bool
    {
        $scanNameWithExtension  = $this->getFullScanName($scan, $scanName);
        $fullPathToScan         = $pathToSaveScan . '/' . $scanNameWithExtension;
        $isScanDeleted          = $this->deleteScan($fullPathToScan);

        return $isScanDeleted;
    }

    /**
     * @param string $fullPathToScan
     * @return bool
     */
    private function deleteScan(string $fullPathToScan): bool
    {
        $isScanDeleted = false;
        $isScanExist = Storage::exists($fullPathToScan);

        if ($isScanExist) {
            $isScanDeleted = Storage::delete($fullPathToScan);
        }

        return $isScanDeleted;
    }

    /**
     * @param UploadedFile $file
     * @param string $filename
     * @return string
     */
    private function getFullScanName(UploadedFile $file, string $filename): string
    {
        $completedFilename = $filename . '.' . $file->getClientOriginalExtension();
        
        return $completedFilename;
    }

    /**
     * @param int $orderId
     * @return string
     */
    private function getPathToSaveScans(int $orderId): string
    {
        return $this->getPathToOrderStorage($orderId) . '/userInfo/';
    }

    /**
     * @param int $orderId
     * @return string
     */
    private function getPathToOrderStorage(int $orderId): string
    {
        return "orders/$orderId";
    }

    /**
     * @param string $pathToSaveScans
     * @param string $pathToFile
     * @return bool|string
     */
    private function copyScanToPublic(string $pathToSaveScans, string $pathToFile): bool|string
    {
        $fullPathToFile = Storage::path($pathToFile);

        $isCopied = Storage::disk('public')->putFile($pathToSaveScans, $fullPathToFile);

        return $isCopied;
    }
}