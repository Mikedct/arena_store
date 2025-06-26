<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    protected $primaryKey = 'adminID';
    public $incrementing = true;

    protected $fillable = [
        'firstName', 'lastName', 'username', 'email',
        'dateOfBirth', 'phoneNumber', 'password'
    ];

    protected $hidden = ['password'];

    public function games()
    {
        return $this->hasMany(Game::class, 'adminID');
    }
}
