<?php

namespace App\Http\Controllers\Admin\Users\Documents\Check;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Yoeunes\Toastr\Toastr;

class CheckDocumentsController extends Controller
{
    /**
     * @param UserRepository $userRepository
     * @param Toastr $toastr
     */
    public function __construct(
        private UserRepository $userRepository,
        private Toastr $toastr
    ){}

    /**
     * @method GET
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = $this->userRepository->getUserWithNeedConfirmDocuments();

        return view('admin.documents.check_documents.index', compact('users'));
    }

    /**
     * @method GET
     * @param int $userId
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($userId): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $user = $this->userRepository->getUserToConfirmDocuments($userId);
        } catch(\Exception $e) {

            $notifyMessage = __('admin.notifications.check_documents.user_not_found');
            $this->toastr->error($notifyMessage);

            return redirect()->back();
        }

        return view('admin.documents.check_documents.edit', compact('user'));
    }
}