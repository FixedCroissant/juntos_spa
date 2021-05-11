<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('stu_id')->nullable();
            $table->foreign('stu_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->string('academic_year', 100)->nullable();
            $table->string('current', 10)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
}
