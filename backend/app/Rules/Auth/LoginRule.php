<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;

use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class LoginRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!request()->has('login')) return true;

        return UserRepository::isValidCredential(
            request()->login,
            request()->password
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Password';
    }
}
