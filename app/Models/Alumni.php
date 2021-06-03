<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = ['student_id','alumni_notes','user_id','current_alumni_status','current_alumni_school'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
