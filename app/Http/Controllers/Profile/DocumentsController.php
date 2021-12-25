<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DocumentsRequest;
use App\Models\Patient_information;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{
    /**
     * @param DocumentsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(DocumentsRequest $request)
    {
        $passport_series    = $request->input('passport_series');
        $passport_number    = $request->input('passport_number');
        $patient_inn        = $request->input('patient_inn');
        $patient_snils      = $request->input('patient_snils');
        $patient            = Auth::user();

        DB::beginTransaction();

        if (empty($patient->patientinfo_id)) {
            $patientInformation = new Patient_information();
        } else {
            $patientInformation = Patient_information::whereId($patient->patientinfo_id)
                                    ->get()->first();
        }

        $patientInformation->passport_series = $passport_series;
        $patientInformation->passport_number = $passport_number;
        $patientInformation->inn             = $patient_inn;
        $patientInformation->snils           = $patient_snils;
        $patientInformation->save();

        if (empty($patient->patientinfo_id)) {
            $patient->patientinfo_id = $patientInformation->id;
            $patient->save();
        }

        DB::commit();

        return redirect()->route('profile.documents');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function profileDocuments(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $patient = Auth::user();

        $patientInformation = null;

        if (!empty($patient->patientinfo_id)) {
            $patientInformation = Patient_information::whereId($patient->patientinfo_id)
                ->get()->first();
        }

        return view('layouts.profile.documents', compact('patientInformation'));
    }
}
