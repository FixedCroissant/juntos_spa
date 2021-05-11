<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id_completed',
        'student_note_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id_completed','id');
    }
}
