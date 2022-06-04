<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class LogoutTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_logout()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $credential = UserRepository::getToken($user->email, 'Password123?');

        $response = UserRepository::logout($credential->access_token);

        $this->assertTrue($response->getData());

        DB::rollBack();
    }
}
