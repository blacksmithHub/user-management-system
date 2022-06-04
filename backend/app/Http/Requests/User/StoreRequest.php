<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'email',
                'unique:App\Models\User,email'
            ],
            'username' => [
                'required',
                'string',
                'unique:App\Models\User,username'
            ],
            'password' => [
                'required',
                'string',
                'confirmed'
            ],
            'first_name' => [
                'required',
                'string'
            ],
            'last_name' => [
                'required',
                'string'
            ],
            'address' => [
                'required',
                'string'
            ],
            'postcode' => [
                'required',
                'string'
            ],
            'phone_number' => [
                'required',
                'string',
                'unique:App\Models\Profile,phone_number'
            ]
        ];
    }
}
