<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline',
        'airline_code',
        'flight_number',
        'origin',
        'destination',
        'available_seats',
        'price',
        'departure',
        'arrival',
        'duration',
        'operational_days'
    ];

    protected $casts = [
        'operational_days' => 'array',
        'departure' => 'datetime',
        'arrival' => 'datetime'
    ];
}
