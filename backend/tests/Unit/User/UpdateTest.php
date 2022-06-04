<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class UpdateTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_update()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $param = User::factory()->make();

        $response = UserRepository::update($user->id, $param->toArray());

        $this->assertModelExists($response);

        DB::rollBack();
    }
}
