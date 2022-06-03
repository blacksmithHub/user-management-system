<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            User::factory()->create([
                'email' => 'admin@mail.test',
                'isAdmin' => true
            ]);

            User::factory(20)->create();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
