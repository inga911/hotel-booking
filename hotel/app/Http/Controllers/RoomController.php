<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomPhotos;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class RoomController extends Controller
{

    public function roomIndexList(RoomType $roomType)
    {
        $roomType = RoomType::findOrFail($roomType->id);
        $roomList = Room::where('room_type_id', $roomType->id)->get();
        $id = Auth::user()->id;
        $admin = User::find($id);

        return view('admin.room.rooms-list-view', compact('roomList', 'roomType', 'admin'));
    }



    public function createRoom()
    {
        $roomTypes = RoomType::all();
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.room.create-room', [
            'roomTypes' => $roomTypes,
            'admin' => $admin
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
            'gallery.*' => 'sometimes|required|image|max:1024',
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

        $id = Room::create([
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
        ])->id;

        foreach ($request->gallery ?? [] as $gallery) {
            RoomPhotos::add($gallery, $id);
        }
        return redirect()->back();
    }

    public function roomEdit(Room $room)
    {
        $roomTypes = RoomType::all();
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.room.edit-room', compact('room', 'roomTypes', 'admin'));
    }

    public function roomUpdate(Request $request, Room $room)
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
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
        RoomPhotos::where('room_id', $room->id)->delete();

        foreach ($request->gallery ?? [] as $gallery) {
            RoomPhotos::add($gallery, $room->id);
        }

        return redirect()->route('admin.room-list', compact('admin'))->withErrors($validator);
    }
}
