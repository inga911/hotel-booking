<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class RoomType extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type_id');
    }
}
