<?php

namespace App\Services\Support\BaseContracts;

interface DestroyInterface
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id);
}
