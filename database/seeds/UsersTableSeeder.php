<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $users = [];

        $role_manager = Role::where('name', 'manager')->first()->id;
        $role_client = Role::where('name', 'client')->first()->id;

        $users[] = [
            'name' => 'Manager Name',
            'email' => 'manager@example.com',
            'password' => bcrypt('manager'),
            'role_id' => $role_manager,
        ];
        $users[] = [
            'name' => 'Client Name',
            'email' => 'client@example.com',
            'password' => bcrypt('client'),
            'role_id' => $role_client,
        ];

        foreach ($users as $data){
            \Illuminate\Support\Facades\DB::table('users')->insert($data);
        }

    }
}
