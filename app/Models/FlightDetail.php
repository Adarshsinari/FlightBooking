<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_date',
        'return_date',
        'departure_city',
        'departure_country',
        'destination_city',
        'destination_country',
        'booking_class',
        'ticket_type',
        'id_proof',
        'person_id',
    ];
}
