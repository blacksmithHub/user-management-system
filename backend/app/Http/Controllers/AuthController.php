<?php

namespace App\Http\Controllers;

use App\Services\Contracts\AuthServiceInterface;
use App\Http\Requests\Auth\{
    LoginRequest,
    RefreshTokenRequest
};

class AuthController extends Controller
{
    /**
     * The service instance.
     *
     * @var \App\Services\Contracts\AuthServiceInterface
     */
    protected $service;

    /**
     * Create the controller instance and resolve its service.
     * 
     * @param \App\Services\Contracts\AuthServiceInterface $service
     */
    public function __construct(AuthServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Request user login.
     * 
     * @param \App\Http\Requests\Auth\LoginRequest
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->service->login($request->validated());
    }

    /**
     * Request user logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return $this->service->logout();
    }

    /**
     * Refresh token action
     *
     * @param \App\Http\Requests\Auth\RefreshTokenRequest $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(RefreshTokenRequest $request)
    {
        return $this->service->refreshToken($request->validated());
    }

    /**
     * Get authenticated user
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAuth()
    {
        return $this->service->getAuth();
    }
}
