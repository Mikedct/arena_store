<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimString extends Middleware
{
    protected $except = [
        'password',
        'password_confirmation',
    ];
}