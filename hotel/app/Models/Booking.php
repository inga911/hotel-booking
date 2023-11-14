<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\BookingRoomList;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assignRooms()
    {
        return $this->hasMany(BookingRoomList::class, 'booking_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
