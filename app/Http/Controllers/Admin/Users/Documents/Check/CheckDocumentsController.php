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
     * @param int $id
     * @return void
     */
    public function edit($id)
    {

    }
}