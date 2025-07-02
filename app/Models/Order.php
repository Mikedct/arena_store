<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;
use App\Models\Payment;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'userID',
        'username',
        'gameID',
        'title',
        'paymentID',
        'totalPrice',
        'orderDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'gameID', 'gameID');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'paymentID', 'paymentID');
    }
}
