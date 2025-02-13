<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_image',
        'name',
        'phone',
        'email',
        'password',
        'email',
        'street_address',
        'city',
        'state',
        'country',
    ];

}

