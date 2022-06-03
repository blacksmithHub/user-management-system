<?php

namespace App\Repositories\Support\Traits;

use Illuminate\Http\Response;

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
