<?php

namespace Database\Seeders;

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
        $this->call(RoleSeeder::class);
        $this->call(StateCountySiteSeeder::class);
        $this->call(ApplicationSettingsSeeder::class);
        $this->call(EventSeeder::class);
    }
}
