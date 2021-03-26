<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Parents;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Parents are created within the StudentSeeder.
        //Parents::factory()->count(25)->create();
    }
}
