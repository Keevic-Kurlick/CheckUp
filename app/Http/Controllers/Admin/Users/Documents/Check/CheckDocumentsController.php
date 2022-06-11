<?php

namespace App\Http\Controllers\Admin\Users\Documents\Check;

use App\Http\Controllers\Admin\Users\Documents\Check\Exceptions\PatientDocumentsAlreadyCheckedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\Documents\ConfirmDocumentsRequest;
use App\Repositories\UserRepository;
use Yoeunes\Toastr\Toastr;

class CheckDocumentsController extends Controller
{
    /**
     * @param UserRepository $userRepository
     * @param Toastr $toastr
     * @param CheckDocumentsManager $checkDocumentsManager
     */
    public function __construct(
        private UserRepository $userRepository,
        private Toastr $toastr,
        private CheckDocumentsManager $checkDocumentsManager
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

    /**
     * @method PATCH
     * @param ConfirmDocumentsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(ConfirmDocumentsRequest $request)
    {
        $result = redirect()->route('admin.users.documents.check');

        $notifyMessage = __('admin.notifications.check_documents.confirmed_success');
        $notifyType = 'success';

        try {
            $this->checkDocumentsManager->confirmDocuments($request);
        } catch(PatientDocumentsAlreadyCheckedException $e) {
            $notifyMessage = __('admin.notifications.check_documents.documents_already_confirmed');

            $notifyType = 'error';

        } catch (\Exception $e) {
            $notifyMessage = __('admin.notifications.check_documents.some_confirmed_error');

            $notifyType = 'error';

            $result = redirect()->back();
        }

        $this->toastr->$notifyType($notifyMessage);

        return $result;
    }
}