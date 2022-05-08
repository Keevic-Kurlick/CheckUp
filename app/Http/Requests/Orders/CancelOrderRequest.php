<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $step
 * @property-read string $cancel_message
 */
class CancelOrderRequest extends FormRequest
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
            'step'              => 'required|string',
            'cancel_message'    => 'required|string|max:2000',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'cancel_message' => 'Причина отказа',
        ];
    }
}
