<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game'; // 🟡 Sesuaikan dengan nama tabel di MySQL (case-sensitive)
    protected $primaryKey = 'gameID'; // 🟡 Primary key kamu
    public $timestamps = false; // 🟡 Karena tidak ada created_at / updated_at

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

    public function payments()
    {
        return $this->hasMany(Payment::class, 'game_id', 'gameID');
    }
}
