<?php

namespace App\Http\Requests\Admin\Users\Documents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $passport_series
 * @property-read string $passport_number
 * @property-read string $inn
 * @property-read string $snils
 */
class ConfirmDocumentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'passport_series' => 'required|string|size:4',
            'passport_number' => 'required|string|size:6',
            'inn'     => 'required|string|size:13',
            'snils'   => 'required|string|size:10',
        ];
    }
}
