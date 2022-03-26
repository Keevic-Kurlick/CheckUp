<?php

namespace App\Repositories\Admin;

use App\Models\Service as Model;
use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getServicesToIndex(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $services = $this->startCondition()
            ->query()
            ->select(['id', 'name', 'description', 'price'])
            ->paginate();

        return $services;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findServiceByIdToEdit(int $id)
    {
        $service = $this->startCondition()->findOrFail($id);

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