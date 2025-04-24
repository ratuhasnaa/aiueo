<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Booking extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'room_id',
        'name',
        'phone',
        'email',
        'start_time',
        'end_time',
        'booking_date',
        'room_variation_id',
        'status',
        'payment_receipt',
        'payment_deadline',
        'total_price',
        'payment_proof',
        'payment_method',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function variation()
    {
        return $this->belongsTo(RoomVariation::class, 'room_variation_id');
    }
    
}
