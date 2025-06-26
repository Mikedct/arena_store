<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'orderID';
    public $incrementing = true;

    protected $fillable = [
        'userID', 'username', 'gameID', 'title',
        'paymentID', 'totalPrice', 'orderDate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'gameID');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'paymentID');
    }
}
