<?php

namespace App\Repositories\Orders;

use App\Models\MedicalCertificate;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Models\Order as Model;

class OrdersRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator $orders
     */
    public function getOrdersToIndex(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $orders = $this->startCondition()
            ->selectRaw('orders.*, users.name as doctor_name, services.name as service_name')
            ->leftjoin('users', 'orders.doctor_id', '=', 'users.id')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->paginate();

        return $orders;
    }

    /**
     * @param int $orderId
     * @return Model
     */
    public function getOrderByIdToShow(int $orderId): Model
    {
        /** @var Order $order */
        $order = $this->startCondition()
            ->with([
                'patient',
                'doctor',
                'service',
                'orderInfo',
            ])
            ->findOrFail($orderId);

        return $order;
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getPassportPathToDownload(int $orderId): string
    {
        /** @var Model $order */
        $passportPath = $this->startCondition()
            ->with([
                'orderInfo'
            ])
            ->findOrFail($orderId)
            ->orderInfo
            ?->passport_path;

        return $passportPath;
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getAnalysisPathToDownload(int $orderId): string
    {
        $analysisPath = $this->startCondition()
            ->with([
                'orderInfo'
            ])
            ->findOrFail($orderId)
            ->orderInfo
            ?->analysis_path;

        return $analysisPath;
    }

    /**
     * @param int $orderId
     * @return Model
     */
    public function getOrderByIdToNextStep(int $orderId): Model
    {
        $order = $this->getOrderQuery()
            ->addSelect([
                'users.name as patient_name',
            ])
            ->leftjoin('users', 'orders.patient_id', '=', 'users.id')
            ->findOrFail($orderId);

        return $order;
    }

    /**
     * @param int $orderId
     * @return Model
     */
    public function getOrderByIdToCancel(int $orderId): Model
    {
        $order = $this->getOrderQuery()
            ->findOrFail($orderId);

        return $order;
    }

    /**
     * @param int $orderId
     * @return MedicalCertificate
     */
    public function getMedicalCertificateByOrderId(int $orderId): MedicalCertificate
    {
        $medicalCertificate = $this->startCondition()
            ->with(['service'])
            ->findOrFail($orderId)
            ->service
            ->medicalCertificate()
            ->select([
                'name',
                'template_path'
            ])
            ->first();

        return $medicalCertificate;
    }

    /**
     * @return mixed
     */
    private function getOrderQuery(): mixed
    {
        $orderQuery = $this->startCondition()
            ->select([
                'orders.*',
                'services.name as service_name',
                'or.approve_message',
                'or.cancel_message',
                'or.certificate_path',
                'oi.passport_series',
                'oi.passport_number',
                'oi.inn',
                'oi.snils',
                'oi.passport_path',
                'oi.analysis_path',
            ])
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->leftjoin('order_information as oi', 'orders.orderInfo_id', '=', 'oi.id')
            ->leftjoin('order_results as or', 'orders.id', '=', 'or.Order_id');

            return $orderQuery;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}