<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Facility extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function roomFacility()
    {
        return $this->belongsTo(Room::class, 'facility_id');
    }
}
