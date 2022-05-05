<?php

namespace App\Repositories\Orders;

use App\Repositories\BaseRepository;
use App\Models\OrderResult as Model;

class OrderResultsRepository extends BaseRepository
{
    /**
     * @param int $orderId
     * @return Model|null
     */
    public function getOrderResultByOrderIdToUpdate(int $orderId): ?Model
    {
        $orderResult = $this->startCondition()
            ->find($orderId);

        return $orderResult;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}