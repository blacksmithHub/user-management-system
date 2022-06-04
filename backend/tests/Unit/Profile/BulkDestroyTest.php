<?php

namespace Tests\Unit\Profile;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\Profile;
use Facades\App\Repositories\Contracts\ProfileRepositoryInterface as ProfileRepository;

class BulkDestroyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        DB::beginTransaction();

        $user = Profile::factory()->create(['user_id' => 0]);

        $ids = $user->pluck('id')->all();

        $response = ProfileRepository::bulkDestroy($ids);

        $this->assertIsInt($response);

        DB::rollBack();
    }
}
