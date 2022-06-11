<?php

namespace App\Policies;

use App\Models\PatientInformation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function hasAccessToAdminPanel(User $user): bool
    {
        $response = false;

        if (!empty($user) && $user->role->name === Role::ROLE_ADMIN) {
            $response = true;
        }

        return $response;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasAccessToOrderService(User $user): bool
    {
        $response = false;

        if (!empty($user)
            && $user?->patientInformation?->check_status === PatientInformation::CHECK_STATUS_CONFIRMED
        ) {
            $response = true;
        }

        return $response;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canOrder(User $user): bool
    {
        $response = false;

        if (!empty($user) && $user->role->name === Role::ROLE_PATIENT) {
            $response = true;
        }

        return $response;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function seeServices(User $user): bool
    {
        $response = false;

        if ($user->role->name === Role::ROLE_PATIENT) {
            $response = true;
        }

        return $response;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasAccessToDoctorOrders(User $user): bool
    {
        $response = false;

        if ($user->role->name === Role::ROLE_DOCTOR) {
            $response = true;
        }

        return $response;
    }
}
