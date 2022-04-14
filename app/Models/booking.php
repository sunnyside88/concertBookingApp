<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'concert_id', 'user_id', 'total_amount'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function concert()
    {
        return $this->hasOne(Seat::class, 'concert_id');
    }
}
