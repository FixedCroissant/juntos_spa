<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DemoUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Demo User
        $user = User::create([
            'name' => 'dasa123',
            'email' => 'dasa123@test.com',
            'password' => Hash::make('password'),
        ]);

         $adminRole = Role::find('1');
         $user->roles()->attach($adminRole);
 
         $this->command->info('Created user DASA Tech (dasa123@test.com) as a administrator.');
        
    }
}
