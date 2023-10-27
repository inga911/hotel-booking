<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{

    public function roomIndexList(RoomType $roomType)
    {
        $roomType = RoomType::findOrFail($roomType->id);
        $roomList = Room::where('room_type_id', $roomType->id)->get();

        return view('admin.room.rooms-list-view', compact('roomList', 'roomType'));
    }



    public function createRoom()
    {
        $roomTypes = RoomType::all();

        return view('admin.room.create-room', [
            'roomTypes' => $roomTypes,
        ]);
    }


    public function roomStore(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'room_name' => 'required',
            'room_type_id' => 'required',
            'total_adult' => 'required',
            'total_child' => 'required',
            'room_capacity' => 'required',
            'photo' => 'sometimes|required|image|max:1024',
            'price' => 'required',
            'size' => 'required',
            'bed_style' => 'required|in:single,double,couch',
            'discount' => 'required',
            'room_availability' => 'required|in:available,unavailable',
            'room_short_desc' => 'required',
            'room_description' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $photo = $request->photo;
        if ($photo) {
            $name = $room->savePhoto($photo);
        }

        Room::create([
            'room_name' => $request->room_name,
            'room_type_id' => $request->room_type_id,
            'total_adult' => $request->total_adult,
            'total_child' => $request->total_child,
            'room_capacity' => $request->room_capacity,
            'photo' => $name ?? null,
            'price' => $request->price,
            'size' => $request->size,
            'bed_style' => $request->bed_style,
            'discount' => $request->discount,
            'room_availability' => $request->room_availability,
            'room_short_desc' => $request->room_short_desc,
            'room_description' => $request->room_description,
        ]);

        return redirect()->back();
    }

    public function roomEdit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('admin.room.edit-room', compact('room', 'roomTypes'));
    }

    public function roomUpdate(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'room_name' => 'required',
            'room_type_id' => 'required',
            'total_adult' => 'required',
            'total_child' => 'required',
            'room_capacity' => 'required',
            'photo' => 'sometimes|required|image|max:1024',
            'price' => 'required',
            'size' => 'required',
            'bed_style' => 'required|in:single,double,couch',
            'discount' => 'required',
            'room_availability' => 'required|in:available,unavailable',
            'room_short_desc' => 'required',
            'room_description' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $photo = $request->photo;
        if ($photo) {
            $name = $room->savePhoto($photo);
        }

        $room->update([
            'room_name' => $request->room_name,
            'room_type_id' => $request->room_type_id,
            'total_adult' => $request->total_adult,
            'total_child' => $request->total_child,
            'room_capacity' => $request->room_capacity,
            'photo' => $name,
            'price' => $request->price,
            'size' => $request->size,
            'bed_style' => $request->bed_style,
            'discount' => $request->discount,
            'room_availability' => $request->room_availability,
            'room_short_desc' => $request->room_short_desc,
            'room_description' => $request->room_description,
        ]);

        return redirect()->route('admin.room.rooms-list-view')->with($validator);
    }
}
