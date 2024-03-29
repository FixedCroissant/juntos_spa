<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Role\HasRoleTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     //Coaching Appointment
     //One to Many
     public function coachingAppointment()
     {
         return $this->hasMany(CoachAppointment::class,'user_id','id');
     }

     //Coordinator Access
     public function studentAccess(){
         return $this->belongsToMany(Sites::class,'coordinator_site','user_id','site_id')->withTimestamps();
     }

}
