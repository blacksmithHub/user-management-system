<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Http\Resources\UserResource;
use App\Repositories\Contracts\{
    ProfileRepositoryInterface,
    UserRepositoryInterface
};
use App\Services\Contracts\UserServiceInterface;

class UserService extends Service implements UserServiceInterface
{
    /**
     * Resource class of the service.
     * 
     * @var \App\Http\Resources\UserResource
     */
    protected $resourceClass = UserResource::class;

    /**
     * Create the service instance and inject its repository.
     *
     * @param App\Repositories\Contracts\UserRepositoryInterface
     * @param App\Repositories\Contracts\ProfileRepositoryInterface
     */
    public function __construct(
        UserRepositoryInterface $repository,
        ProfileRepositoryInterface $profileRepository
    ) {
        $this->repository = $repository;
        $this->profileRepository = $profileRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return mixed
     */
    public function store(array $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->repository->create($request);

            Arr::set($request, 'user_id', $user->id);

            $this->profileRepository->create($request);

            DB::commit();

            $user = $this->repository->model()->with('profile')->find($user->id);

            return $this->setResponseResource($user);
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
