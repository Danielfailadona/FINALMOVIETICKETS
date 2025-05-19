<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

   protected $fillable = [
    'title',
    'description',
    'genre',
    'release_date',
    'duration_minutes',
    'language',
    'amount',
    'showing_time',
    'quantity',  // add this
];



    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function tickets()
{
    return $this->hasMany(Ticket::class);
}

}

