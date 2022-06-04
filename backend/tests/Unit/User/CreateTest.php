<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class CreateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create()
    {
        DB::beginTransaction();

        $user = User::factory()->make();

        $param = $user->toArray();

        Arr::set($param, 'password', 'Password123?');

        $response = UserRepository::create($param);

        $this->assertModelExists($response);

        DB::rollBack();
    }
}
