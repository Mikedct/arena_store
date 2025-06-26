<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userID';
    public $timestamps = false;

    protected $fillable = [
        'firstName', 'lastName', 'username',
        'email', 'dateOfBirth', 'phoneNumber', 'password'
    ];
}
