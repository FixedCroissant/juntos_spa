<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustCoachAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coach_appointments', function (Blueprint $table) {
            $table->renameColumn('Additional_Information','appointmentNotes');
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
            $table->renameColumn('appointmentNotes','Additional_Information');
        });
    }
}
