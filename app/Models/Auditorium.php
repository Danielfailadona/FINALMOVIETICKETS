<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditorium extends Model
{
    protected $table = 'auditoriums'; // ✅ Fix table name
    protected $fillable = [
        'name',
        'seating_capacity',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}


