<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         //Add to faker instance
         $this->faker->addProvider(new \App\FakerProviders\LocalSchools($this->faker));        
        
        return [
            //
                'school_name'=>$this->faker->localHighSchool,
                'school_county'=>$this->faker->county
        ];
    }
}
