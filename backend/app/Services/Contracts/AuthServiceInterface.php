<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    /**
     * Request user login.
     * 
     * @param array $request
     * @return mixed
     */
    public function login(array $request);

    /**
     * Request user logout.
     *
     * @return mixed
     */
    public function logout();

    /**
     * Refresh token action
     *
     * @param array $request
     * @return mixed
     */
    public function refreshToken(array $request);

    /**
     * Get authenticated user
     * 
     * @return mixed
     */
    public function getAuth();
}
