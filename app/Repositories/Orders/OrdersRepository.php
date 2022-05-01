<?php

namespace App\Repositories\Orders;

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
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}