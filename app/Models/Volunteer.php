<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_first_name','volunteer_last_name','address_line_1','county','email_address','phone_number','city','state','zip','site_id'
    ];
}
