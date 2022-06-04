<?php

namespace App\Services\Support\BaseContracts;

interface IndexInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param array $request
     * @return \Illuminate\Support\LazyCollection|\Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(array $request);
}
