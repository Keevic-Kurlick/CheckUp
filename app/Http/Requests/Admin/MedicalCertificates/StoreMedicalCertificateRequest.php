<?php

namespace App\Http\Requests\Admin\MedicalCertificates;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property-read string $medical_certificate_name
 * @property-read string $medical_certificate_description
 * @property-read UploadedFile $medical_certificate_template
 */
class StoreMedicalCertificateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'medical_certificate_name'          => 'required|string',
            'medical_certificate_description'   => 'required|string',
            'medical_certificate_template'      => 'file|mimes:doc,docx',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'medical_certificate_name'          => __('admin.medical_certificates.pages.create.medical_certificate_name'),
            'medical_certificate_description'   => __('admin.medical_certificates.pages.create.medical_certificate_description'),
            'medical_certificate_template'      => __('admin.medical_certificates.pages.create.medical_certificate_template'),
        ];
    }
}
