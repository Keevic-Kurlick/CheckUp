<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string    $service_name
 * @property-read string    $service_description
 * @property-read int       $service_price
 * @property-read int       $service_medical_certificate
 */
class UpdateServiceRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'service_name'                  => 'required|string',
            'service_description'           => 'required|string',
            'service_price'                 => 'required|int',
            'service_medical_certificate'   => 'required|int',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'service_name'                  => __('admin.services.pages.edit.service_name'),
            'service_description'           => __('admin.services.pages.edit.service_description'),
            'service_price'                 => __('admin.services.pages.edit.service_price'),
            'service_medical_certificate'   => __('admin.services.pages.edit.service_medical_certificate.label'),
        ];
    }
}
