<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Twenty-five students with 1 parents a piece and 1 default site attached.
        Student::factory()->count(25)->create(['site_id'=>1])->each(function ($studentRecord){
                //Create one parent.
                $myParent = \App\Models\Parents::factory()->make();
               //Attach to student.
               $studentRecord->parent()->save($myParent);

        });
    }
}
