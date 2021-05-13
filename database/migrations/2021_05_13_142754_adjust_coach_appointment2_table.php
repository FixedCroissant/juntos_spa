<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustCoachAppointment2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coach_appointments', function (Blueprint $table) {
            $table->string('appointment_follow_up_duration',25)->nullable();
            $table->string('appointment_follow_up_method_of_contact',100)->nullable();
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
            $table->dropColumn(['appointment_follow_up_duration','appointment_follow_up_method_of_contact']);
        });
    }
}
