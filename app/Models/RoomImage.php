<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'image',
        'is_primary',
    ];
    

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    
}
