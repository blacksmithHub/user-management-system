<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\{
    Profile,
    User
};

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

            $users = User::all();

            foreach ($users as $user) {
                Profile::factory()->create([
                    'user_id' => $user->id
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
