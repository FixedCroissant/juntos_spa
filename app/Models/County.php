<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class county extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_id','county_name' 
      ];
    
    public function State()
    {
        return $this->belongsTo(States::class,'state_id','id');
    }
}
