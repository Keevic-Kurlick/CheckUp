<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'passport_series' => 'required|string|size:4',
            'passport_number' => 'required|string|size:6',
            'patient_inn'     => 'required|string|size:13',
            'patient_snils'   => 'required|string|size:10',
        ];
    }
}
