<?php

namespace App\Repositories\Contracts;

use App\Repositories\Support\BaseContracts\{
    CreateInterface as Create,
    UpdateInterface as Update
};

interface UserRepositoryInterface extends Create, Update
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

    /**
     * Logout the user
     *
     * @param String $id
     * @return mixed
     */
    public function logout(String $id);

    /**
     * Refresh the user token
     *
     * @param String $token
     * @return mixed
     */
    public function getTokenViaRefreshToken(String $token);

    /**
     * Attempt to authorize user
     * 
     * @param String $login
     * @param String $password
     * @return bool
     */
    public function isValidCredential(String $login, String $password);

    /**
     * Get authenticated user
     * 
     * @return mixed
     */
    public function getAuth();

    /**
     * Multiple delete user.
     * 
     * @param array $ids
     * @return mixed
     */
    public function bulkDestroy(array $ids);
}
