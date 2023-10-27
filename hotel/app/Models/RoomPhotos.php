<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class RoomPhotos extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function roomPhoto()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
