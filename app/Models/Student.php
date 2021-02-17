<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'school_id','school_name','student_first_name','student_last_name'  
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
}
