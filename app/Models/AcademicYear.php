<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'stu_id',
        'academic_year',
        'current',
        'start_date',
        'end_date'
    ];

    public function schedule(){
        return $this->hasMany(Schedule::class,'student_id','stu_id');
    }
}
