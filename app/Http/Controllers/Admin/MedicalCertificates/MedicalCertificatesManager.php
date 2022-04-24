<?php

namespace App\Http\Controllers\Admin\MedicalCertificates;

use App\Http\Controllers\Admin\MedicalCertificates\Exceptions\ErrorSavingMedicalCertificateException;
use App\Http\Controllers\Admin\MedicalCertificates\Exceptions\SavingMedicalCertificateTemplateException;
use App\Http\Requests\Admin\MedicalCertificates\StoreMedicalCertificateRequest;
use App\Http\Requests\Admin\MedicalCertificates\UpdateMedicalCertificateRequest;
use App\Models\MedicalCertificate;
use App\Services\DocxProcessor\DTO\MedicalCertificateDocxParamsDTO;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MedicalCertificatesManager
{
    /**
     * @param StoreMedicalCertificateRequest $request
     * @return void
     * @throws \Throwable
     */
    public function storeMedicalCertificate(StoreMedicalCertificateRequest $request): void
    {
        $pathToTemplate = $this->storeMedicalCertificateTemplate(
            $request->file('medical_certificate_template'),
            $request->medical_certificate_name
        );

        if (empty($pathToTemplate)) {
            throw new SavingMedicalCertificateTemplateException('Medical certificate template was not saved.');
        }

        DB::beginTransaction();

        try {
            $medicalCertificate = new MedicalCertificate();
            $medicalCertificate->name = $request->medical_certificate_name;
            $medicalCertificate->description = $request->medical_certificate_description;
            $medicalCertificate->template_path = $pathToTemplate;
            $medicalCertificate->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            $isDeletedMedicalCertificateTemplate = $this->deleteMedicalCertificateTemplate($pathToTemplate);

            \Log::info(
                'app.Http.Controllers.Admin.MedicalCertificates.MedicalCertificatesManager.storeMedicalCertificate',
                [
                    'message'   => 'Failed to store medical certificate.',
                    'data'      => [
                        'exception_message'     => $e->getMessage(),
                        'is_template_deleted'   => $isDeletedMedicalCertificateTemplate,
                        'path_to_template'      => $pathToTemplate,
                    ],
                ]
            );

            throw new ErrorSavingMedicalCertificateException('Failed to store medical certificate');
        }
    }

    /**
     * @param UploadedFile $medicalCertificateTemplate
     * @param string $medicalCertificateName
     * @return string|null
     */
    private function storeMedicalCertificateTemplate(
        UploadedFile $medicalCertificateTemplate,
        string $medicalCertificateName
    ): ?string {
        $templateName = $this->getMedicalCertificateTemplateName($medicalCertificateTemplate, $medicalCertificateName);

        $pathToSaveMedicalCertificate = "medical_certificates/templates";

        $medicalCertificateTemplatePath =
            $medicalCertificateTemplate->storeAs($pathToSaveMedicalCertificate, $templateName);

        return $medicalCertificateTemplatePath;
    }

    /**
     * @param UploadedFile $medicalCertificateTemplate
     * @param string $medicalCertificateName
     * @return string
     */
    private function getMedicalCertificateTemplateName(
        UploadedFile $medicalCertificateTemplate,
        string $medicalCertificateName
    ): string {
        $medicalCertificateTemplateName =
            Str::slug($medicalCertificateName) . '.' . $medicalCertificateTemplate->getClientOriginalExtension();

        return $medicalCertificateTemplateName;
    }

    /**
     * @param string $pathToMedicalCertificateTemplate
     * @return bool
     */
    private function deleteMedicalCertificateTemplate(string $pathToMedicalCertificateTemplate): bool
    {
        $isDeleted = Storage::delete($pathToMedicalCertificateTemplate);

        return $isDeleted;
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

    /**
     * @return array
     */
    public function getMedicalCertificatesTemplateParams(): array
    {
        $medicalCertificateTemplateParams = MedicalCertificateDocxParamsDTO::getTemplateParams();

        return $medicalCertificateTemplateParams;
    }
}