<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $primaryKey = 'orderID';
    public $incrementing = true;

    protected $fillable = [
        'userID', 'username', 'gameID', 'title',
        'paymentID', 'totalPrice', 'orderDate'
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
