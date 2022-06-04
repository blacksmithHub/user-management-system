<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class GetTokenViaRefreshTokenTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_token_via_refresh_token()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $credential = UserRepository::getToken($user->email, 'Password123?');

        $response = UserRepository::getTokenViaRefreshToken($credential->refresh_token);

        $this->assertObjectHasAttribute('access_token', $response);

        DB::rollBack();
    }
}
