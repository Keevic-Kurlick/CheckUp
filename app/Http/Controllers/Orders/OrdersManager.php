<?php

namespace App\Http\Controllers\Orders;

use App\Http\Requests\Orders\CancelOrderRequest;
use App\Http\Requests\Orders\CompleteOrderRequest;
use App\Http\Requests\Orders\NextStepOrderRequest;
use App\Models\MedicalCertificate;
use App\Models\Order;
use App\Models\OrderResult;
use App\Models\User;
use App\Repositories\Orders\OrdersRepository;
use App\Services\DocxProcessor\DTO\MedicalCertificateDocxParamsDTO;
use App\Services\DocxProcessor\Interfaces\DocxProcessorInterface;
use App\Services\PdfConverter\DTO\PdfConverterDTO;
use App\Services\PdfConverter\PdfConverterManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersManager
{
    /**
     * @param OrdersRepository $ordersRepository
     * @param DocxProcessorInterface $docxProcessorService
     */
    public function __construct(
        private OrdersRepository       $ordersRepository,
        private DocxProcessorInterface $docxProcessorService
    ) {}

    /**
     * @param Order $order
     * @return array|string[]
     */
    public function getNextSteps(Order $order): array
    {
        $nextSteps      = [];
        $isStepsExists  = array_key_exists($order->status, Order::SEQUENCE_STEPS);

        if (!empty($isStepsExists)) {
            $nextSteps = Order::SEQUENCE_STEPS[$order->status];
        }

        if (in_array(Order::COMPLETE_STATUS, $nextSteps)) {
            $hasCertificatePath = !empty($order?->orderResult?->certificate_path);

            if ($hasCertificatePath) {
                $nextSteps = array_filter($nextSteps, function ($step) {
                    return $step !== Order::CANCEL_STATUS;
                });
            }

            if (!$hasCertificatePath) {
                $nextSteps = array_filter($nextSteps, function ($step) {
                    return $step !== Order::COMPLETE_STATUS;
                });

                array_unshift($nextSteps, Order::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE);
            }
        }

        return $nextSteps;
    }

    /**
     * @param NextStepOrderRequest $request
     * @param Order $order
     * @param User $doctor
     * @return void
     * @throws \Throwable
     */
    public function handleNextStatus(NextStepOrderRequest $request, Order $order, User $doctor)
    {
        $nextStatus = $request->step;

        switch ($nextStatus)
        {
            case Order::IN_PROGRESS_STATUS: {
                $this->inProgressHandle($order, $nextStatus, $doctor);

                break;
            }
            case Order::ADDITIONAL_STEP_MAKE_MEDICAL_CERTIFICATE: {
                $this->makeMedicalCertificateHandler($order);

                break;
            }
        }
    }

    /**
     * @param CompleteOrderRequest $request
     * @param int $orderId
     * @return void
     * @throws \Throwable
     */
    public function completeStatusHandler(CompleteOrderRequest $request, int $orderId)
    {
        DB::beginTransaction();

        Order::whereId($orderId)
            ->update([
                'status' => Order::COMPLETE_STATUS,
            ]);

        if (!empty($request->approve_message)) {
            OrderResult::query()
                ->where('Order_id', $orderId)
                ->update([
                    'approve_message' => $request->approve_message,
                ]);
        }

        DB::commit();
    }

    /**
     * @param Order $order
     * @return void
     * @throws \Throwable
     */
    private function makeMedicalCertificateHandler(Order $order)
    {
        /** @var MedicalCertificate $medicalCertificate */
        $medicalCertificate = $this->ordersRepository->getMedicalCertificateByOrderId($order->id);

        $pathToResult = $this->getPathToResult($order->id);
        $resultFilename = $this->getMedicalCertificateResultName($medicalCertificate);
        $resultPdfPath  = $this->getResultPdfPath($pathToResult, $resultFilename);

        $this->generateDirectoriesByPathToResult($pathToResult);

        $medicalCertificateDTO =
            $this->prepareMedicalCertificateDTO($order, $medicalCertificate, $pathToResult, $resultFilename);

        $pathToDocxResult   = $this->generateDocxResult($medicalCertificateDTO);

        $pdfConverterDTO    = $this->preparePdfConverterDTO($pathToDocxResult, $resultPdfPath);

        $this->convertDocxResultToPdf($pdfConverterDTO);

        DB::beginTransaction();

        /** @var OrderResult $orderResult */
        $orderResult = OrderResult::query()
            ->where('Order_id', $order->id)
            ->updateOrCreate([
                'certificate_path' => $resultPdfPath,
            ],
            [
                'certificate_path' => $resultPdfPath,
                'Order_id' => $order->id,
            ]
        );

        Order::whereId($order->id)
            ->update([
                'orderResult_id' => $orderResult->id,
            ]);

        DB::commit();
    }

    /**
     * @param string $resultPath
     * @param string $resultFilename
     * @return string
     */
    private function getResultPdfPath(string $resultPath, string $resultFilename): string
    {
        $resultPdfPath = $resultPath . $resultFilename . '.pdf';

        return $resultPdfPath;
    }

    /**
     * @param string $pathToResult
     * @return bool
     */
    private function generateDirectoriesByPathToResult(string $pathToResult): bool
    {
        $isMaked = \Storage::makeDirectory($pathToResult);

        return $isMaked;
    }

    /**
     * @param PdfConverterDTO $pdfConverterDTO
     * @return string
     */
    private function convertDocxResultToPdf(PdfConverterDTO $pdfConverterDTO): string
    {
        $pdfConverterManager = new PdfConverterManager($pdfConverterDTO);

        $pathToPdfResult = $pdfConverterManager->convert();

        return $pathToPdfResult;
    }

    /**
     * @param MedicalCertificateDocxParamsDTO $medicalCertificateDTO
     * @return string
     * @throws \Exception
     */
    private function generateDocxResult(MedicalCertificateDocxParamsDTO $medicalCertificateDTO): string
    {
        $this->docxProcessorService->setDocxProcessorDTO($medicalCertificateDTO);
        $pathToResult = $this->docxProcessorService->run();

        return $pathToResult;
    }

    /**
     * @param string $pathToDocxResult
     * @param string $pathToResult
     * @return PdfConverterDTO
     */
    private function preparePdfConverterDTO(string $pathToDocxResult, string $resultPdfPath): PdfConverterDTO
    {
        $pdfConverterDTO = PdfConverterDTO::make();
        $pdfConverterDTO->setPathToFile($pathToDocxResult)
            ->setPathToResult($resultPdfPath)
            ->setFileExtension(PdfConverterDTO::FILE_EXTENSION_WORD2007);

        return $pdfConverterDTO;
    }

    /**
     * @param Order $order
     * @param MedicalCertificate $medicalCertificate
     * @param string $pathToResult
     * @param string $resultName
     * @return MedicalCertificateDocxParamsDTO
     */
    private function prepareMedicalCertificateDTO(
        Order $order,
        MedicalCertificate $medicalCertificate,
        string $pathToResult,
        string $resultName
    ): MedicalCertificateDocxParamsDTO
    {
        $pathToTemplate =  $medicalCertificate->template_path;

        $patientName            = $order->patient_name;
        $patientPassportSeries  = $order->passport_series;
        $patientPassportNumber  = $order->passport_number;
        $patientInn             = $order->inn;
        $patientSnils           = $order->snils;

        $medicalCertificateDTO = MedicalCertificateDocxParamsDTO::make($pathToTemplate, $pathToResult);
        $medicalCertificateDTO->setResultName($resultName)
            ->setPatientName($patientName)
            ->setPatientPassportSeries($patientPassportSeries)
            ->setPatientPassportNumber($patientPassportNumber)
            ->setPatientInn($patientInn)
            ->setPatientSnils($patientSnils);

        return $medicalCertificateDTO;
    }

    /**
     * @param MedicalCertificate $medicalCertificate
     * @return string
     */
    private function getMedicalCertificateResultName(MedicalCertificate $medicalCertificate): string
    {
        $medicalCertificateFilename = Str::slug($medicalCertificate->name);

        return $medicalCertificateFilename;
    }

    /**
     * @param int $orderId
     * @return string
     */
    private function getPathToResult(int $orderId): string
    {
        return "orders/$orderId/medical_certificates/results/";
    }

    /**
     * @param CancelOrderRequest $request
     * @param Order $order
     * @return Order
     * @throws \Throwable
     */
    public function cancelOrder(CancelOrderRequest $request, Order $order): Order
    {
        $cancelMessage  = $request->cancel_message;

        DB::beginTransaction();

        /** @var OrderResult $orderResult */
        $orderResult = OrderResult::query()
            ->where('Order_id', $order->id)
            ->updateOrCreate(
                [
                    'cancel_message' => $cancelMessage,
                ],
                [
                    'Order_id'          => $order->id,
                    'cancel_message'    => $cancelMessage,
                ]
        );

        $order->update([
            'status' => Order::CANCEL_STATUS,
            'orderResult_id' => $orderResult->id,
        ]);

        DB::commit();

        return $order;
    }

    /**
     * @param Order $order
     * @param string $nextStatus
     * @param User $doctor
     * @return void
     * @throws \Throwable
     */
    private function inProgressHandle(Order $order, string $nextStatus, User $doctor)
    {
        DB::beginTransaction();
        $order->update([
            'status'    => $nextStatus,
            'doctor_id' => $doctor->id,
        ]);
        DB::commit();
    }
}