<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\Contracts\ProfileRepositoryInterface;

class ProfileRepository extends Repository implements ProfileRepositoryInterface
{
    /**
     * Create the repository instance.
     *
     * @param \App\Models\Profile
     */
    public function __construct(Profile $model)
    {
        $this->model = $model;
    }

    /**
     * Multiple delete user.
     * 
     * @param array $userIds
     * @return mixed
     */
    public function bulkDestroy(array $userIds)
    {
        return $this->model->whereIn('user_id', $userIds)->delete();
    }
}
