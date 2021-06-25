<?php

namespace Database\Factories;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Volunteer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
                'volunteer_first_name'=>$this->faker->firstName,
                'volunteer_last_name'=>$this->faker->lastName,
                'address_line_1'=>$this->faker->streetAddress,
                'county'=>'County',
                'city'=>$this->faker->city,
                'state'=>$this->faker->state,
                'zip'=>$this->faker->postcode,
                'email_address'=>$this->faker->safeEmail,
                'phone_number'=>$this->faker->phoneNumber,
                'site_id'=>$this->faker->numberBetween($min = 1, $max = 1)
        ];
    }
}
