<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppointmentDurationCoaching extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coach_appointments', function (Blueprint $table) {
            $table->string('appointment_duration',25)->after('appointment_date')->nullable();

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
            $table->dropColumn('appointment_duration');
        });
    }
}
