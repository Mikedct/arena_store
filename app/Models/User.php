<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'userID';
    public $incrementing = true;

    protected $fillable = [
        'firstName', 'lastName', 'username', 'email',
        'dateOfBirth', 'phoneNumber', 'password', 'api_token'
    ];

    protected $hidden = ['password', 'api_token'];
}
