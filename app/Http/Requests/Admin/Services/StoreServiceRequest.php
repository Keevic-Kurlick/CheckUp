<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string    $service_name
 * @property-read string    $service_description
 * @property-read int       $service_price
 */
class StoreServiceRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'service_name'          => 'required|string',
            'service_description'   => 'required|string',
            'service_price'         => 'required|int',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'service_name' => __('admin.services.pages.create.service_name'),
            'service_description' => __('admin.services.pages.create.service_description'),
            'service_price' => __('admin.services.pages.create.service_price'),
        ];
    }
}
