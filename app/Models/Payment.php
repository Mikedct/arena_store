<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $primaryKey = 'paymentID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'game_id',
        'paymentMethod',
        'paymentStatus',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'paymentID', 'paymentID');
    }
}
