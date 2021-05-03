<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','parent_first_name','parent_last_name','address_line_1','city','state','zip',
        'phone_number',
        'emailaddress'
      ];


    /**
     * Inverse of Student/Parent relationship
     */
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }

    //Event Attendance
    public function parentAttendance()
    {
        return $this->belongsToMany(Event::class,'event_attendance','event_id','student_id');
    }

}
