<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $passport_series
 * @property-read string $passport_number
 * @property-read string $patient_inn
 * @property-read string $patient_snils
 */
class DocumentsRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'passport_series' => 'required|string|size:4',
            'passport_number' => 'required|string|size:6',
            'patient_inn'     => 'required|string|size:13',
            'patient_snils'   => 'required|string|size:10',
        ];
    }
}
