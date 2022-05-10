<?php

namespace App\Repositories\Profile;

use App\Models\Order as Model;
use App\Repositories\BaseRepository;

class OrdersRepository extends BaseRepository
{
    /**
     * @param $patient
     * @return array
     */
    public function getOrdersToIndexByPatient($patient): array
    {
        $orders = $this->startCondition()
            ->selectRaw('orders.*,
                                  services.name as service_name,
                                  services.price as service_price')
            ->wherePatientId($patient->id)
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->get()
            ->map(function ($order) {
                return [
                    'id'            => $order->id,
                    'service_name'  => $order->service_name,
                    'service_price' => $order->service_price,
                    'created_at'    => $order->created_at->format('d.m.Y'),
                    'status'        => Model::STATUS_MAP[$order->status],
                ];
            })
            ->toArray();

        return $orders;
    }

    /**
     * @param int $orderId
     * @return Model
     */
    public function getOrderToShow(int $orderId): Model
    {
        /** @var Model $order */
        $order = $this->startCondition()
            ->with([
                'doctor',
                'orderResult',
                'service'  => fn($service) => $service->withTrashed(),
            ])
            ->findOrFail($orderId);

        return $order;
    }

    /**
     * @param int $orderId
     * @return Model
     */
    public function getOrderToDownload(int $orderId): Model
    {
        /** @var Model $order */
        $order = $this->startCondition()
            ->with([
                'orderResult',
                'service'  => fn($service) => $service->withTrashed(),
            ])
            ->findOrFail($orderId);

        return $order;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}