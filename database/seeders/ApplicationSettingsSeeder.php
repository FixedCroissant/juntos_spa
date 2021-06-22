<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class ApplicationSettingsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Settings::create(['coordinator_follow_up_meeting_past_due'=>'15','front_page_text'=>'<p>Dummy text.</p>']);
    }
}
