<?php

namespace App\Http\Controllers\Admin\Users\Documents\Check;

use App\Http\Controllers\Admin\Users\Documents\Check\Exceptions\PatientDocumentsAlreadyCheckedException;
use App\Http\Requests\Admin\Users\Documents\ConfirmDocumentsRequest;
use App\Models\PatientInformation;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class CheckDocumentsManager
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        private UserRepository $userRepository
    ){}

    /**
     * @param ConfirmDocumentsRequest $request
     * @return void
     * @throws PatientDocumentsAlreadyCheckedException
     * @throws \Throwable
     */
    public function confirmDocuments(ConfirmDocumentsRequest $request)
    {
        $patientId = $request->route()->parameter('id');

        $user = $this->userRepository->getUserToConfirmDocuments($patientId);

        if ($user->patientInformation->check_status === PatientInformation::CHECK_STATUS_CONFIRMED) {
            throw new PatientDocumentsAlreadyCheckedException('Patient documents already checked.');
        }

        DB::beginTransaction();

        PatientInformation::wherePatientId($patientId)
            ->update([
                'passport_series'   => $request->passport_series,
                'passport_number'   => $request->passport_number,
                'inn'               => $request->inn,
                'snils'             => $request->snils,
                'check_status'      => PatientInformation::CHECK_STATUS_CONFIRMED,
            ]);

        DB::commit();
    }
}