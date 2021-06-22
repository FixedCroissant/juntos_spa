<?php

namespace Database\Factories;

use App\Models\County;
use Illuminate\Database\Eloquent\Factories\Factory;


class CountyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = County::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'state_id'=>'1',
            'county_name'=>'Wake',
        ];
    }
}
