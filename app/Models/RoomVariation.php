<?php
// app/Models/RoomVariation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id', 'name', 'capacity_u_shape', 'capacity_double_u_shape',
        'capacity_theatre', 'capacity_classroom', 'capacity_round_table',
        'capacity_cocktail', 'size', 'price_per_hour',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}

