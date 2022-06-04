<?php

namespace App\Repositories\Contracts;

use App\Repositories\Support\BaseContracts\{
    CreateInterface as Create,
    UpdateInterface as Update
};

interface ProfileRepositoryInterface extends Create, Update
{
    /**
     * Multiple delete user.
     * 
     * @param array $userIds
     * @return mixed
     */
    public function bulkDestroy(array $userIds);
}
