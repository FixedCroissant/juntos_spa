<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('grade')->nullable();
            //rename school_id to site_it
            $table->renameColumn('school_id', 'site_id');
            //Archive student
            $table->string('active_student')->nullable();
            //Student Academic Year.
            $table->string('academic_year')->nullable();
            //Survey Information
            //Pre Survey Completed? Y/N
            $table->string('pre_survey_completed')->nullable();
            //Post Survey Completed? Y/N
            $table->string('post_survey_completed')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('grade');
            $table->renameColumn('site_id', 'school_id');

        });
    }
}
