<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //Student ID.
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            //Period_ID
            $table->integer('period_id')->nullable();
            //Year
            $table->string('semester_year')->nullable();            
            //Semester Number
            $table->integer('semester_number')->nullable();
            //Grade
            $table->string('grade',250)->nullable();            
            //Schedule Type (Block or AB)
            $table->string('schedule_type')->nullable();
            //Class Name
            $table->string('class_name')->nullable();
            //Teacher Name
            $table->string('teacher_name')->nullable();
            $table->string('room_number')->nullable();
            $table->text('notes_lunch_period')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
