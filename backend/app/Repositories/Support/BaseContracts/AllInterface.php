<?php

namespace App\Repositories\Support\BaseContracts;

interface AllInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param array $request
     * @return \Illuminate\Support\LazyCollection
     */
    public function all(array $request);
}
