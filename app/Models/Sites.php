<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    use HasFactory;

    protected $fillable = [
        'county_id','site_name' 
      ];

    public function County()
    {
        return $this->belongsTo(County::class,'county_id','id');
    }

    //Access
    public function coordinatorAccess(){
        return $this->belongsToMany(\User::class,'coordinator_site','site_id','user_id')->withTimestamps();
    }
    
}
