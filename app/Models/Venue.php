<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
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
