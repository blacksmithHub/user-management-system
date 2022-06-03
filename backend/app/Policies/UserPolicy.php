<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user is administrator.
     * 
     * @param \App\Models\User $user
     * @return bool
     */
    public function administrator(User $user)
    {
        return $user->isAdmin;
    }
}
