<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    /**
     * Request a token for the given credentials on /oauth/token passport
     * (Internal request)
     *
     * @param String $login,
     * @param String $password
     * @return object
     */
    public function getToken(String $login, String $password);
}
