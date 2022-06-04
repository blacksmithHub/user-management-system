<?php

namespace Tests\Unit\User;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Models\User;
use Facades\App\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class BulkDestroyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_bulk_destroy()
    {
        DB::beginTransaction();

        $user = User::factory(3)->create();

        $ids = $user->pluck('id')->all();

        $response = UserRepository::bulkDestroy($ids);

        $this->assertIsInt($response);

        DB::rollBack();
    }
}
