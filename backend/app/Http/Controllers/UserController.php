<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use App\Http\Requests\User\{
    DestroyRequest,
    IndexRequest,
    StoreRequest,
    UpdateRequest,
};

class UserController extends Controller
{
    /**
     * The service instance.
     *
     * @var \App\Services\Contracts\UserServiceInterface
     */
    protected $service;

    /**
     * Create the controller instance and resolve its service.
     * 
     * @param \App\Services\Contracts\UserServiceInterface $service
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\User\IndexRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return $this->service->index($request->validated());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateRequest  $request
     * @param  int|string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\User\DestroyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request)
    {
        return $this->service->bulkDestroy($request->validated());
    }
}
