<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear;


class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','period_id','semester_year','semester_number','grade','schedule_type','class_name','teacher_name','room_number','notes_lunch_period',
        'monday','tuesday','wednesday','thursday','friday','acad_id','academic_grade'
      ];

    public function acadYear(){
        return $this->hasMany(AcademicYear::class,'stu_id','student_id');
    }
}
