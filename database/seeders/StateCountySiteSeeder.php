<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\States;
use App\Models\County;
use App\Models\Sites;

class StateCountySiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //State
        States::factory()->count(1)->create();
        //County
        County::factory()->count(1)->create();
        //Site
        Sites::factory()->count(1)->create();
    }
}
