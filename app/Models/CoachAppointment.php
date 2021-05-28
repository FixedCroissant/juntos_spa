<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachAppointment extends Model
{
    use HasFactory;


    protected $fillable = [
        'student_id',
        'user_id',
        'start_gpa',
        'end_gpa',
        'acad_year_id',
        'StudentCounselor',
        'EducationalGoals',
        'appointment_date',
        'appointment_duration',
        'appointment_follow_up_date',
        'method_of_contact',
        'appointmentNotes',
        'follow_up_notes',
        'actions_needed',
        'actions_made',
        'results',
        'appointment_follow_up_method_of_contact',
        'appointment_follow_up_duration'
      ];

    protected $dates = ['appointment_date','appointment_follow_up_date'];


    //Inverse of has many.
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    //Get User information of the coaching appointment.
    public function coach(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //Academic Year
    public function acadYear(){
        return $this->belongsTo(AcademicYear::class,'acad_year_id','id');
    }
}
