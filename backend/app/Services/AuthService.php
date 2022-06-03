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

    /**
     * Logout Action
     *
     * @return mixed
     */
    public function logout()
    {
        return $this->userRepository->logout(request()->user()->token()->id);
    }

    /**
     * Refresh token action
     *
     * @param array $request
     * @return mixed
     */
    public function refreshToken($request)
    {
        return $this->userRepository->getTokenViaRefreshToken(Arr::get($request, 'refresh_token'));
    }

    /**
     * Get authenticated user
     * 
     * @return mixed
     */
    public function getAuth()
    {
        return $this->userRepository->getAuth();
    }
}
