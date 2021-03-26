<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Standard Permissions
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'Coordinator',
            'slug' => 'Coordinator',
        ]);
        DB::table('roles')->insert([
            'name' => 'Staff',
            'slug' => 'Staff',
        ]);
        DB::table('roles')->insert([
            'name' => 'Guest',
            'slug' => 'Guest',
        ]);

        
        
    }
}
