<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'student_id','student_first_name','student_last_name','address_line_1','city','state','zip' 
    ];

    //
    public function school()
    {
        return $this->hasMany(School::class,'id','school_id');
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
    //Get information of the coaching appointment
    public function coach(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
    
    //Event Attendance
    public function attendance()
    {
        return $this->belongsToMany(Event::class,'event_attendance');
    }
}