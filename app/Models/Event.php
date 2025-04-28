<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'country', 'capacity', 'start_time', 'end_time'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
