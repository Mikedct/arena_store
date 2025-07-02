<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Order;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';
    protected $primaryKey = 'gameID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'gameCode',
        'title',
        'genre',
        'platform',
        'price',
        'releaseDate',
        'developer',
        'publisher'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'game_id', 'gameID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'game_id', 'gameID');
    }
}
