<?php

namespace App\Http\Controllers\Admin\MedicalCertificates;

use App\Http\Requests\Admin\MedicalCertificates\StoreMedicalCertificateRequest;
use App\Http\Requests\Admin\MedicalCertificates\UpdateMedicalCertificateRequest;
use App\Models\MedicalCertificate;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    /**
     * @param UpdateMedicalCertificateRequest $request
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function updateMedicalCertificateById(UpdateMedicalCertificateRequest $request, int $id)
    {
        $medicalCertificateName         = $request->medical_certificate_name;
        $medicalCertificateDescription  = $request->medical_certificate_description;

        DB::beginTransaction();

        /** @var MedicalCertificate|ModelNotFoundException $medicalCertificate */
        $medicalCertificate = MedicalCertificate::findOrFail($id);
        $medicalCertificate->update([
            'name'          => $medicalCertificateName,
            'description'   => $medicalCertificateDescription,
        ]);

        DB::commit();
    }

    /**
     * @param int $id
     * @return void
     * @throws \Throwable
     */
    public function destroyMedicalCertificate(int $id)
    {
        DB::beginTransaction();

        /** @var MedicalCertificate|ModelNotFoundException $medicalCertificate */
        $medicalCertificate = MedicalCertificate::findOrFail($id);
        $medicalCertificate->delete();

        DB::commit();
    }
}