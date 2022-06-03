<?php

namespace App\Services;

use Illuminate\Support\Arr;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;

class AuthService extends Service implements AuthServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     * @param App\Repositories\Contracts\UserRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Request user login.
     * 
     * @param array $request
     * @return mixed
     */
    public function login(array $request)
    {
        return $this->userRepository->getToken(Arr::get($request, 'email'), Arr::get($request, 'password'));
    }
}
