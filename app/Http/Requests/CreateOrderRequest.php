<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property-read string          $passport_series
 * @property-read string          $passport_number
 * @property-read string          $patient_inn
 * @property-read string          $patient_snils
 * @property-read UploadedFile    $patient_passport_scan
 * @property-read UploadedFile    $patient_analysis_scan
 */
class CreateOrderRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('hasAccessToOrderService');
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'passport_series'       => 'required|string|size:4',
            'passport_number'       => 'required|string|size:6',
            'patient_inn'           => 'required|string|size:13',
            'patient_snils'         => 'required|string|size:10',
            'patient_passport_scan' => 'required|image',
            'patient_analysis_scan' => 'required|image',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'passport_series'       => 'Серия паспорта',
            'passport_number'       => 'Номер паспорта',
            'patient_inn'           => 'ИНН',
            'patient_snils'         => 'СНИЛС',
            'patient_passport_scan' => 'Скан паспорта',
            'patient_analysis_scan' => 'Скан анализов',
        ];
    }
}
