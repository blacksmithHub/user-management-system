<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('perform-administrator-action');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'sometimes',
                'email',
                'unique:App\Models\User,email'
            ],
            'username' => [
                'required',
                'sometimes',
                'string',
                'unique:App\Models\User,username'
            ],
            'password' => [
                'required',
                'sometimes',
                'string',
                'confirmed'
            ],
            'first_name' => [
                'required',
                'sometimes',
                'string'
            ],
            'last_name' => [
                'required',
                'sometimes',
                'string'
            ],
            'address' => [
                'required',
                'sometimes',
                'string'
            ],
            'postcode' => [
                'required',
                'sometimes',
                'string'
            ],
            'phone_number' => [
                'required',
                'sometimes',
                'string',
                'unique:App\Models\Profile,phone_number'
            ]
        ];
    }
}
