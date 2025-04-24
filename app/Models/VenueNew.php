<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueNew extends Model
{
    use HasFactory;

    protected $table = 'venues_new';

    protected $fillable = [
        'name',
        'address',
        'city',
        'price',
        'capacity',
        'category',
        'description',
        'image'
    ];
}


