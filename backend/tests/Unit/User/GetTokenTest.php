<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class GetTokenTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_token()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $response = UserRepository::getToken($user->email, 'Password123?');

        $this->assertObjectHasAttribute('access_token', $response);

        DB::rollBack();
    }
}
