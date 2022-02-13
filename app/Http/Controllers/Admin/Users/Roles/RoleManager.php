<?php

namespace App\Http\Controllers\Admin\Users\Roles;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleManager
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    /**
     * @param array $usersWithRoles
     * @throws \Throwable
     */
    public function editRole(array $usersWithRoles)
    {
        /** @var \Illuminate\Support\Collection<User> $users */
        $users = $this->userRepository->getUsersByIds(array_keys($usersWithRoles));

        /** @var \Illuminate\Support\Collection<User> $usersChangeRole */
        $usersChangeRoleIds = $users->filter(function ($user) use ($usersWithRoles) {
            $isChangeUserRole = false;

            foreach ($usersWithRoles as $userId => $roleId) {
                if ((int)$userId === (int)$user->id && (int)$user->role_id !== (int)$roleId) {
                    $isChangeUserRole = true;
                    break;
                }
            }

            return $isChangeUserRole;
        })->map(function ($user) {
            return $user->id;
        })->toArray();

        DB::beginTransaction();

        foreach ($usersChangeRoleIds as $userId) {
            User::whereId($userId)
                ->update([
                    'role_id' => $usersWithRoles[$userId],
                ]);
        }

        DB::commit();

        Log::info('App.Http.Controllers.Admin.Users.Roles.RoleManager.EditRole',
            [
                'message' => 'User roles have been changed',
                'data' => [
                    'editor_id' => \Auth::user()->id,
                    'users_change_role' => $usersChangeRoleIds,
                ]
            ]
        );
    }
}