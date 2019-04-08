<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);

            factory(\App\Models\User::class, 20)->create();

            \Illuminate\Support\Facades\File::deleteDirectory(storage_path().'\app\messenger\claims\\', 0777, true);
            factory(\App\Models\Upload::class, 100)->create();
            factory(\App\Models\Claim::class, 15)->create();

    }
}
