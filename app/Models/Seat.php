<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = true;

    protected $table = 'seats';
    protected $keyType = 'string';

    protected $attributes = [
        'isBooked' => false,
    ];

    protected $fillable = [
        'concert_id', 'booking_id'
    ];

    public function concert()
    {
        return $this->belongsTo(concert::class);
    }

    public function booking()
    {
        return $this->hasOne(booking::class);
    }
}
