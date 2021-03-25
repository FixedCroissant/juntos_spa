<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','period_id','semester_year','semester_number','grade','schedule_type','class_name','teacher_name','room_number','notes_lunch_period' 
      ];
}
