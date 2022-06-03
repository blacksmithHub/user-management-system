<?php

namespace App\Repositories\Support\BaseContracts;

interface UpdateInterface
{
    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @return mixed
     */
    public function update($id);
}
