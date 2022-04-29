<?php

namespace App\Repositories\Menu;

use App\Repositories\BaseRepository;
use App\Models\Service as Model;

class ServiceRepository extends BaseRepository
{
    /**
     * @param int $serviceId
     * @return mixed
     */
    public function getServiceToMakeOrderById(int $serviceId): mixed
    {
        $service = $this->startCondition()->find($serviceId);

        return $service;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}