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
}
