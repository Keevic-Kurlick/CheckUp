<?php

namespace App\Http\Requests\Admin\Users\Documents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $patientName
 */
class IndexCheckDocumentsRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'patientName' => 'nullable|string',
        ];
    }
}
