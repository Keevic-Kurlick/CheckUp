<?php

namespace App\Http\Requests\Admin\MedicalCertificates;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $medical_certificate_name
 * @property-read string medical_certificate_description
 */
class UpdateMedicalCertificateRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'medical_certificate_name'          => 'required|string',
            'medical_certificate_description'   => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'medical_certificate_name'          => __('admin.medical_certificates.pages.edit.medical_certificate_name'),
            'medical_certificate_description'   => __('admin.medical_certificates.pages.edit.medical_certificate_description'),
        ];
    }
}
