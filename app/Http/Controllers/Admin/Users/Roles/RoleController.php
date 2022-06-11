<?php

namespace App\Http\Controllers\Admin\Users\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\EditRoleRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Yoeunes\Toastr\Toastr;
use function view;

class RoleController extends Controller
{
    /**
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param RoleManager $roleManager
     * @param Toastr $toastr
     */
    public function __construct(
        private UserRepository $userRepository,
        private RoleRepository $roleRepository,
        private RoleManager $roleManager,
        private Toastr $toastr
    ){}

    /**
     * @method GET
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editRolesView()
    {
        $users = $this->userRepository->getUsersToAssignRole();
        $roles = $this->roleRepository->getRolesToAssignRole();

        return view('admin.users.roles.edit', compact('users', 'roles'));
    }

    /**
     * @method POST
     * @param EditRoleRequest $editRoleRequest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editRoles(EditRoleRequest $editRoleRequest)
    {
        $notifyMessage = __('admin.notifications.role.role_was_changed.success');

        try {
            $this->roleManager->editRole($editRoleRequest->users);
        } catch (\Exception $e) {
            $notifyMessage = __('admin.notifications.role.role_was_changed.error');
        }

        $this->toastr->success($notifyMessage);

        return redirect()->route('admin.users.roles.edit');
    }
}
