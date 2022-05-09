<?php

namespace App\Http\Requests\Profile\Orders;

use Illuminate\Foundation\Http\FormRequest;

class DownloadMedicalCertificateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
