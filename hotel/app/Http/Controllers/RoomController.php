<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomPhotos;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
            'admin' => $admin,
        ]);
    }



    public function roomStore(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'room_name' => 'required',
            'room_number' => 'required',
            'room_type_id' => 'required',
            'total_adult' => 'required',
            'total_child' => 'required',
            'photo' => 'sometimes|required|image|max:1024',
            'gallery.*' => 'sometimes|required|image|max:1024',
            'price' => 'required',
            'bed_style' => 'required|in:single,double,king',
            'extra_child_bed' => 'required',
            'status' => 'required|in:active,inactive',
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
            $name = $room->savePhoto($photo, $room->id);
        }

        $id = Room::create([
            'room_name' => $request->room_name,
            'room_number' => $request->room_number,
            'room_type_id' => $request->room_type_id,
            'total_adult' => $request->total_adult,
            'total_child' => $request->total_child,
            'photo' => $name ?? null,
            'price' => $request->price,
            'bed_style' => $request->bed_style,
            'extra_child_bed' => $request->extra_child_bed,
            'status' => $request->status,
            'room_short_desc' => $request->room_short_desc,
            'room_description' => $request->room_description,
        ])->id;

        foreach ($request->gallery ?? [] as $gallery) {
            RoomPhotos::add($gallery, $id);
        }
        return redirect()->back()->with('success', 'Room was created successfully');
    }

    public function roomEdit(Room $room)
    {
        $room = Room::findOrFail($room->id);
        $roomTypes = RoomType::all();
        $id = Auth::user()->id;
        $admin = User::find($id);
        $editData = Room::find($id);
        return view('admin.room.edit-room', compact('room', 'roomTypes', 'admin', 'editData'));
    }

    public function roomUpdate(Request $request, Room $room)
    {

        $id = Auth::user()->id;
        $admin = User::find($id);
        $room = Room::findOrFail($room->id);
        $validator = Validator::make($request->all(), [
            'room_name' => 'sometimes|required',
            'room_number' => 'sometimes|required',
            'room_type_id' => 'sometimes|required',
            'total_adult' => 'sometimes|required',
            'total_child' => 'sometimes|required',
            'photo' => 'sometimes|required|image|max:1024',
            'gallery.*' => 'sometimes|required|image|max:1024',
            'price' => 'sometimes|required',
            'bed_style' => 'sometimes|required|in:single,double,king',
            'extra_child_bed' => 'sometimes|required',
            'room_short_desc' => 'sometimes|required',
            'room_description' => 'sometimes|required',
            'status' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        if ($request->delete == 1) {
            if ($room->photo) {
                $room->deletePhoto();
            }
            return redirect()->back();
        }

        $photoName = $request->hasFile('photo') ? $room->savePhoto($request->photo, $room->id) : $room->photo;
        $updateData = $request->only([
            'room_name',
            'room_number',
            'room_type_id',
            'total_adult',
            'total_child',
            'price',
            'bed_style',
            'extra_child_bed',
            'room_short_desc',
            'room_description',
            'status',
        ]);
        if ($request->hasFile('photo')) {
            $updateData['photo'] = $photoName;
        }
        $room->update($updateData);

        if ($request->has('gallery')) {
            foreach ($request->gallery as $gallery) {
                RoomPhotos::add($gallery, $room->id);
            }
        }
        return redirect()->back()->with('success', 'Room was updated successfully');
    }


    public function destroy(Room $room)
    {
        if ($room->gallery->count()) {
            foreach ($room->gallery as $gal) {
                $gal->deletePhoto();
            }
        }

        if ($room->photo) {
            $room->deletePhoto();
        }

        $room->delete();
        return redirect()->back()->with('success', 'Room was deleted successfully');
    }

    public function destroyPhoto(RoomPhotos $photo)
    {
        $photo->deletePhoto();
        return redirect()->back()->with('success', 'Photo deleted successfully');
    }
}
