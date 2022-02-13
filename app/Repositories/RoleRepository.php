<?php

namespace App\Repositories;

use App\Models\Role as Model;

class RoleRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getRolesToAssignRole()
    {
        $roles = $this->startCondition()->all()->all();

        return $roles;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}