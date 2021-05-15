<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'application_settings';

    protected $fillable = [
        'coordinator_follow_up_meeting_past_due'
    ];
}
