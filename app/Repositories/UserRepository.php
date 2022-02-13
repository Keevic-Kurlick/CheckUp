<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\User as Model;

class UserRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getUsersToAssignRole()
    {
        $users = $this->startCondition()
            ->join('roles as r', 'users.role_id', '=','r.id')
            ->selectRaw('users.*, r.name as user_role_name')
            ->paginate();

        return $users;
    }

    /**
     * @param int[] $ids
     * @return \Illuminate\Support\Collection<User>
     */
    public function getUsersByIds(array $ids): \Illuminate\Support\Collection
    {
        $users = $this->startCondition()
            ->whereIn('id', $ids)
            ->get()
            ->toBase();

        return $users;
    }


    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }


}