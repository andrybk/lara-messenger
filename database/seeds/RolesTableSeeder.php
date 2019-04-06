<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [];

        $roles[] = [
            'name' => 'client',

        ];
        $roles[] = [
            'name' => 'manager',

        ];

        foreach ($roles as $data){
            \Illuminate\Support\Facades\DB::table('roles')->insert($data);
        }

    }
}
