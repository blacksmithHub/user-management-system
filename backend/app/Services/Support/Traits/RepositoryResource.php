<?php

namespace App\Services\Support\Traits;

trait RepositoryResource
{
    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(array $request)
    {
        return $this->setResponseResource(
            $this->repository->create($request)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int|string $id
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function update($id, array $request)
    {
        return $this->setResponseResource(
            $this->repository->update($id, $request)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|string $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
