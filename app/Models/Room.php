<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_title',
        'description',
        'location',
        'price',
        'wifi',
        'room_type',
    ];
    
    public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }


    public function variations()
    {
        return $this->hasMany(RoomVariation::class);
    }




}
