<?php

namespace App\Http\Controllers\Admin\MedicalCertificates;

use App\Http\Requests\Admin\MedicalCertificates\StoreMedicalCertificateRequest;
use App\Models\MedicalCertificate;
use Illuminate\Support\Facades\DB;

class MedicalCertificatesManager
{
    /**
     * @param StoreMedicalCertificateRequest $request
     * @return void
     * @throws \Throwable
     */
    public function storeMedicalCertificate(StoreMedicalCertificateRequest $request)
    {
        DB::beginTransaction();

        $service = new MedicalCertificate();
        $service->name = $request->medical_certificate_name;
        $service->description = $request->medical_certificate_description;
        $service->save();

        DB::commit();
    }
}