<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //Items that should be retained with coaching.

            //Student Demographic Information.
            //Connect with our student table.
            $table->unsignedBigInteger('student_id');
            //Set Foreign Key Constraint
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //GPA (may not be the best location.)
            $table->string('start_gpa')->nullable();
            $table->string('end_gpa')->nullable();
            
            $table->text('Additional_Information')->nullable();
            $table->text('StudentCounselor')->nullable();
            $table->text('EducationalGoals')->nullable();

                       

            //Individual meeting notes and outcomes.
            $table->date('appointment_date')->nullable();
            $table->string('method_of_contact')->nullable();
            //Follow up notes to keep about appointment.
            $table->text('follow_up_notes')->nullable();
            $table->text('actions_needed')->nullable();
            //Outcomes, Actions Made & Results.
            $table->date('appointment_follow_up_date')->nullable();
            $table->text('actions_made')->nullable();
            $table->text('results')->nullable();




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coach_appointments');
    }
}
