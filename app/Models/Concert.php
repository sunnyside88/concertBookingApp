<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;


    protected $table = 'concert';

    protected $primaryKey = 'concert_id';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'title', 'dateTime', 'performer', 'venue',
    ];

    public $timestamps = true;
}
