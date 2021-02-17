<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    
    


    //Load custom faker provider.
/*$factory->define($model,function(Faker $faker)
{
      //Add Custom Provider -- this one for local schools in the area.
      $faker->addProvider(new \App\FakerProviders\LocalSchools($faker));
});*/



    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            //
                'student_id'=>$this->faker->numberBetween($min = 1, $max = 9) ,
                'student_first_name'=>$this->faker->firstName,
                'student_last_name'=>$this->faker->lastName,
                'address_line_1'=>$this->faker->streetAddress,
                'city'=>$this->faker->city,
                'state'=>$this->faker->state,
                'zip'=>$this->faker->postcode,
                'coordinator'=>$this->faker->name,
                'events_id'=>'1'
        ];
    }
}
