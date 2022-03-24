<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seat';
    protected $primaryKey = 'seat_id';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $attributes = [
        'isBooked' => false,
    ];

    protected $fillable = [
        'concert_id',
    ];

    public $timestamps = false;
}
