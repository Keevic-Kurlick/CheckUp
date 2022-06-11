<?php

namespace App\Repositories;

use App\Models\PatientInformation;
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
     * @return \Illuminate\Support\Collection<Model>
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
     * @param int $id
     * @return mixed
     */
    public function getUserToShowServiceById(int $id): mixed
    {
        $user = $this->startCondition()
            ->with(['patientInformation'])
            ->find($id);

        return $user;
    }

    /**
     * @return mixed
     */
    public function getUserWithNeedConfirmDocuments(): mixed
    {
        $users = $this->startCondition()
            ->selectRaw('users.id, users.name, users.email, pi.updated_at')
            ->patient()
            ->join(
                'patient_information as pi',
                'users.patientinfo_id',
                '=',
                'pi.id'
            )->where(
                'pi.check_status',
                '=',
                PatientInformation::CHECK_STATUS_NEED_CONFIRM
            )->paginate();

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