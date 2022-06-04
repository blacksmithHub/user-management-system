<?php

namespace Tests\Unit\Profile;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\Profile;
use Facades\App\Repositories\Contracts\ProfileRepositoryInterface as ProfileRepository;

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

        $profile = Profile::factory()->create(['user_id' => 0]);

        $param = Profile::factory()->make(['user_id' => 0]);

        $response = ProfileRepository::update($profile->id, $param->toArray());

        $this->assertModelExists($response);

        DB::rollBack();
    }
}
