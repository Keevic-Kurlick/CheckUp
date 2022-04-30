<?php

namespace App\Policies;

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

        if (!empty($user)) {
            $response = true;
        }

        return $response;
    }
}
