<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'paymentID';
    public $incrementing = true;

    protected $fillable = [
        'paymentMethod', 'paymentStatus'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'paymentID');
    }
}
