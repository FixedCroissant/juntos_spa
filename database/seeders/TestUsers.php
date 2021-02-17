<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class TestUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Testing Users.
        //Test User Number 1.
        DB::table('users')->insert([
            'name' => 'josh',
            'email' => 'josh@test.com',
            'password' => \Hash::make('password'),
        ]);

        //Test User 2
        DB::table('users')->insert([
            'name' => 'mike',
            'email' => 'mike@test.com',
            'password' => \Hash::make('secret'),
        ]);
    }
}
