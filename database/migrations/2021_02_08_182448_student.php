<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create students
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('school_id')->nullable();
            $table->string('school_name')->nullable();
            $table->string('student_first_name')->nullable();
            $table->string('student_last_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
