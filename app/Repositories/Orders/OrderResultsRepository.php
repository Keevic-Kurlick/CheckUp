<?php

namespace App\Repositories\Orders;

use App\Repositories\BaseRepository;
use App\Models\OrderResult as Model;

class OrderResultsRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}