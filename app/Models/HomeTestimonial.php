<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTestimonial extends Model
{
    protected $fillable = [
        'name',
        'message',
        'profile_picture',
        'status',
    ];
}
