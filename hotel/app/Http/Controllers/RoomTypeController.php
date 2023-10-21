<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Intervention\Image\Facades\Image;


class RoomTypeController extends Controller
{
    public function roomTypeList()
    {
        $roomType = RoomType::orderBy('id', 'desc')->get();

        return view('admin.room.room-types.room-type-view', compact('roomType'));
    }

    public function addRoomType()
    {
        return view('admin.room.room-types.add-room-type');
    }

    public function roomTypeStore(Request $request)
    {
        RoomType::insert([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.room-list');
    }
}
