<?php

namespace Database\Factories;

use App\Models\Sites;
use Illuminate\Database\Eloquent\Factories\Factory;


class SitesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sites::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'county_id'=>'1',
            'site_name'=>'FakeSite1',
        ];
    }
}
