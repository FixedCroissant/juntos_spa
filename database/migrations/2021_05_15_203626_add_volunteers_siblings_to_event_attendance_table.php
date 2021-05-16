<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVolunteersSiblingsToEventAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_attendance', function (Blueprint $table) {
            $table->integer('volunteer_id')->unsigned()->default(0);
            $table->integer('sibling_number')->default(0);
            $table->integer('other_guests_number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_attendance', function (Blueprint $table) {
            $table->dropColumn(['volunteer_id','sibling_number','other_guests_number']);
        });
    }
}
