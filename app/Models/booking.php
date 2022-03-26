<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_id', 'concert_id', 'user_id',
    ];

    public function seat()
    {
        return $this->belongsTo(seat::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
