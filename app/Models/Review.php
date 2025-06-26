<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'reviewID';
    public $incrementing = true;

    protected $fillable = [
        'userID', 'username', 'gameID', 'title', 'text', 'rating', 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'gameID');
    }
}

