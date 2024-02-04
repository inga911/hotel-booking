<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    const SORT = [
        'default' => 'Default',
        'price_asc' => 'Low price to high price',
        'price_desc' => 'High price to low price',
    ];

    const FILTER = [
        'default' => 'Show all',
        'single' => 'Single room',
        'double' => 'Double room',
        'single_no_kids' => 'Single room without child',
        'double_no_kids' => 'Double room without child',
        'single_with_kids' => 'Single room with child',
        'double_with_kids' => 'Double room with child'
    ];


    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'facility_id');
    }

    public function gallery()
    {
        return $this->hasMany(RoomPhotos::class, 'room_id');
    }

    public function lastBooking()
    {
        return $this->hasOne(Booking::class)->latest();
    }

    public function bookingStatus()
    {
        return Booking::where('room_id', $this->id)
            ->where('status', 0)
            ->where('status', 2)
            ->count();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailableToday()
    {
        $today = Carbon::today();

        return !$this->bookings()
            ->whereDate('check_in', '<=', $today)
            ->whereDate('check_out', '>=', $today)
            ->exists();
    }

    public function savePhoto(UploadedFile $photo): string
    {
        $name = $photo->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/upload/room_photos/';
        $photo->move($path, $name);
        return $name;
    }

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/upload/room_photos/' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }

    public function isAvailableForDates($checkIn, $checkOut)
    {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);

        $overlap = $this->bookings()
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($q) use ($checkInDate, $checkOutDate) {
                    $q->where('check_in', '<=', $checkInDate)
                        ->where('check_out', '>=', $checkInDate);
                })
                    ->orWhere(function ($q) use ($checkInDate, $checkOutDate) {
                        $q->where('check_in', '<', $checkOutDate)
                            ->where('check_out', '>=', $checkOutDate);
                    });
            })
            ->count();

        $totalRooms = $this->room_numbers_count;
        $availableRooms = max(0, $totalRooms - $overlap);

        return $availableRooms > 0;
    }
}
