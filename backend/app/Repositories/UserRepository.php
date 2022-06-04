<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Support\Traits\Authenticate;

class UserRepository extends Repository implements UserRepositoryInterface
{
    use Authenticate;

    /**
     * Model Relationships
     * 
     * @var array
     */
    protected $relationMethods = [
        'profile'
    ];

    /**
     * Create the repository instance.
     *
     * @param \App\Models\User
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Multiple delete user.
     * 
     * @param array $ids
     * @return mixed
     */
    public function bulkDestroy(array $ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }
}
