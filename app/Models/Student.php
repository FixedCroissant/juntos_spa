<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'student_id','student_first_name','student_last_name','address_line_1','city','state','zip',
       'ethnicity','school_name','age','phone_number','dob',
        'email_address',
        'active_student',
        'academic_year',
        'pre_survey_completed',
        'post_survey_completed',
        'county',
        'site_id',
        'graduated'
    ];

    protected $dates = ['dob'];

    //ToDo-Address this so that it works with sites.
    public function school()
    {
        return $this->hasMany(School::class,'id','school_id');
    }


    public function notes()
    {
        return $this->hasMany(StudentNote::class,'student_id','id');
    }

    public function parent()
    {
        return $this->hasMany(Parents::class,'student_id','id');
    }

    //Coaches
    public function coachAppointments(){
        return $this->hasMany(CoachAppointment::class,'student_id','id');
    }

    //May be temporary
    //Get user information of the coaching appointment
    public function coach(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //Event Attendance
    public function attendance()
    {
        return $this->belongsToMany(Event::class,'event_attendance');
    }
}
