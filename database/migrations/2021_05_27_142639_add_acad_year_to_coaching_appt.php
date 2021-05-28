<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcadYearToCoachingAppt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coach_appointments', function (Blueprint $table) {
            //add academic year
            $table->unsignedBigInteger('acad_year_id')->nullable();
            $table->foreign('acad_year_id')->references('id')->on('academic_years')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coach_appointments', function (Blueprint $table) {

        });
    }
}
