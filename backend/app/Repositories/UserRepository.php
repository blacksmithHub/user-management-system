<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Support\Traits\Authenticate;

class UserRepository extends Repository implements UserRepositoryInterface
{
    use Authenticate;

    /**
     * Create the repository instance.
     *
     * @param \App\Models\User
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
