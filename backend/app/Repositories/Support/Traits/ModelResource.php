<?php

namespace App\Repositories\Support\Traits;

use Illuminate\Support\Arr;

trait ModelResource
{
    /**
     * Display a listing of the resource.
     *
     * @param array $request
     * @return \Illuminate\Support\LazyCollection
     */
    public function all(array $request)
    {
        return Arr::has($request, 'page') ?
            $this->model->with($this->relationMethods)->paginate(Arr::get($request, 'per_page') ?? 10) :
            $this->model->cursor();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $request)
    {
        return $this->model->create($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int|string $id
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $request)
    {
        $model = $this->model->findOrFail($id);

        $model->update($request);

        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return int
     */
    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return 1;
    }
}
