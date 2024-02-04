<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;

class RoomListController extends Controller
{
    public function viewRoomList()
    {
        $admin = Auth::user();
        $room_type_list = RoomType::all();
        $room_number_list = Room::paginate(10);
        $bookings_list = Booking::all();

        return view('admin.room.booked-room-list', compact('room_type_list', 'room_number_list', 'bookings_list', 'admin'));
    }
}
