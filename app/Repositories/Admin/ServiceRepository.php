<?php

namespace App\Repositories\Admin;

use App\Models\Service;
use App\Repositories\BaseRepository;
use App\Models\Role as Model;

class ServiceRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getServicesToIndex(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $services = Service::query()
            ->select(['id', 'name', 'description', 'price'])
            ->paginate();

        return $services;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}