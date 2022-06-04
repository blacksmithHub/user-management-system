<?php

namespace Tests\Unit\Profile;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\User;
use App\Models\Profile;
use Facades\App\Repositories\Contracts\ProfileRepositoryInterface as ProfileRepository;

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

        $user = User::factory()->create();

        $profile = Profile::factory()->make(['user_id' => $user->id]);

        $param = $profile->toArray();

        $response = ProfileRepository::create($param);

        $this->assertModelExists($response);

        DB::rollBack();
    }
}
