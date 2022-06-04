<?php

namespace App\Repositories\Support\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\{
    RefreshTokenRepository,
    TokenRepository
};

trait Authenticate
{
    /**
     * oauth token endpoint
     *
     * @var String
     */
    protected $endpoint = 'oauth/token';

    /**
     * Request a token for the given credentials on /oauth/token passport
     * (Internal request)
     *
     * @param String $login,
     * @param String $password
     * @return object
     */
    public function getToken(String $login, String $password)
    {
        $url = sprintf('%s', $this->endpoint);

        $params = [
            'grant_type' => 'password',
            'client_id' => config('services.auth.client_id'),
            'client_secret' => config('services.auth.client_secret'),
            'username' => $login,
            'password' => $password,
            'scope' => '*'
        ];

        $request = request()->create($url, 'POST', $params);
        $response = app()->handle($request);

        return $this->handle($response);
    }

    /**
     * Logout the user
     *
     * @param String $id
     * @return mixed
     */
    public function logout(String $id)
    {
        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        $tokenRepository->revokeAccessToken($id);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($id);

        return response()->json(true);
    }

    /**
     * Refresh the user token
     *
     * @param String $token
     * @return mixed
     */
    public function getTokenViaRefreshToken($token)
    {
        $url = sprintf('%s', $this->endpoint);

        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token,
            'client_id' => config('services.auth.client_id'),
            'client_secret' => config('services.auth.client_secret'),
            'scope' => '*'
        ];

        $request = request()->create($url, 'POST', $params);
        $response = app()->handle($request);

        return $this->handle($response);
    }

    /**
     * Attempt to authorize user
     * 
     * @param String $login
     * @param String $password
     * @return bool
     */
    public function isValidCredential(String $login, String $password)
    {
        $params = [];

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $params['email'] = $login;
        } else {
            $params['username'] = $login;
        }

        $params['password'] = $password;

        $attempt = Auth::attempt($params);

        return $attempt;
    }

    /**
     * Get authenticated user
     * 
     * @return mixed
     */
    public function getAuth()
    {
        return $this->model->find(Auth::id());
    }

    /**
     * Handle authentication response
     *
     * @return mixed
     */
    private function handle(Response $response)
    {
        switch ($response->status()) {
            case 200:
                return json_decode($response->content());
            default:
                abort($response->status(), 'Invalid Credential');
        }
    }
}
