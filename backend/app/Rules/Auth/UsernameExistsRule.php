<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;

use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class UsernameExistsRule implements Rule
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
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return UserRepository::model()->where('username', $value)->exists();
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Username';
    }
}
