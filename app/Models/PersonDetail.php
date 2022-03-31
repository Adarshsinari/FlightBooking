<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'salutation',
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
    ];
}
