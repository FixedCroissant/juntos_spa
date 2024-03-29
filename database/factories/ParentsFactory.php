<?php

namespace Database\Factories;

use App\Models\Parents;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parents::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            //
                'parent_first_name'=>$this->faker->firstName,
                'parent_last_name'=>$this->faker->lastName,
                'address_line_1'=>$this->faker->streetAddress,
                'city'=>$this->faker->city,
                'state'=>"NC",
                'zip'=>$this->faker->postcode,

        ];
    }
}
