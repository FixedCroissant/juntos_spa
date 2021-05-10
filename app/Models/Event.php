<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_start_date','event_end_date','event_type','event_city','event_state','event_zip','event_name','event_notes','contact_hours'
      ];

    protected $dates = ['event_start_date','event_end_date'];


    //Student Attendance
    public function attendance()
    {
        return $this->belongsToMany(Student::class,'event_attendance','event_id','student_id')->withTimestamps();
    }

    //Parent Attendance
    public function parentAttendance()
    {
        return $this->belongsToMany(Parents::class,'event_attendance','event_id','parent_id')->withTimestamps();
    }

    /*
     * Volunteer attendance.
     * TO BE CREATED LATER.
     * return $this->belongsToMany(Volunteer::class,'event_attendance','event_id','volunteer_id')->withTimestamps();
     */




}
