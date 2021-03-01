<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function attendance()
    {
        return $this->belongsToMany(Attendance::class,'event_attendance_pivot','event_id','attendance_id');
    }
}
