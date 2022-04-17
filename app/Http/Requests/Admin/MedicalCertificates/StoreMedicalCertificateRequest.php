<?php

namespace App\Http\Requests\Admin\MedicalCertificates;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $medical_certificate_name
 * @property-read string $medical_certificate_description
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
        ];
    }
}
