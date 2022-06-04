<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class IsValidCredentialTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_is_valid_credential()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $response = UserRepository::isValidCredential($user->email, 'Password123?');

        $this->assertTrue($response);

        DB::rollBack();
    }
}
