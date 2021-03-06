<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;


    protected $table = 'concerts';

    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'title', 'date', 'performer', 'venue', 'time', 'totalSeats', 'price', 'posterUrl'
    ];

    public $timestamps = true;

    public function seats()
    {
        return $this->hasMany(Seat::class, 'concert_id');
    }
}
