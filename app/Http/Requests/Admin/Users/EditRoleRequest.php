<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $users
 * [user_id, role_id]
 */
class EditRoleRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'users' => 'array',
        ];
    }
}
