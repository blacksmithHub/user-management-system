<?php

namespace App\Services\Contracts;

use App\Services\Support\BaseContracts\{
    StoreInterface as Store,
    UpdateInterface as Update,
    IndexInterface as Index
};

interface UserServiceInterface extends Store, Update, Index
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  array  $request
     * @return mixed
     */
    public function bulkDestroy(array $request);
}
