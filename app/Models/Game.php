<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $primaryKey = 'gameID'; // Kalau primary key bukan id
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'gameCode', 'title', 'genre', 'platform',
        'price', 'releaseDate', 'developer', 'publisher',
        'description', 'image', 'adminID'
    ];
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'adminID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'gameID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'gameID');
    }
}
