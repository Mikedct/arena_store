<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'adminID';
    public $timestamps = false;

    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'email',
        'phoneNumber',
        'dateOfBirth',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
