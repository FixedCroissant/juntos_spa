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
        'Additional_Information',
        'StudentCounselor',
        'EducationalGoals',
        'appointment_date',
        'appointment_follow_up_date', 
        'method_of_contact', 
        'follow_up_notes', 
        'actions_needed',  
        'actions_made',
        'results'
      ];
    
    
    //Inverse of has many.
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    //Get User information of the coaching appointment.
    public function coach(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
