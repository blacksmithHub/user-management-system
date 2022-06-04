<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class GetAuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_auth()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        Auth::login($user);

        $response = UserRepository::getAuth();

        $this->assertModelExists($response);

        DB::rollBack();
    }
}
