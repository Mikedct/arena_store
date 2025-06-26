<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $primaryKey = 'gameID';
    public $incrementing = true;

    protected $fillable = [
        'gameCode', 'title', 'genre', 'platform', 'price',
        'releaseDate', 'developer', 'publisher', 'description',
        'image', 'adminID'
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
