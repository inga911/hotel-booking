<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\BookArea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class RoomTypeController extends Controller
{
    public function roomTypeList()
    {
        $roomType = RoomType::all();
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.room.room-types.room-type-view', compact('roomType', 'admin'));
    }

    public function addRoomType()
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.room.room-types.add-room-type', compact('admin'));
    }

    public function roomTypeStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        RoomType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.room-list');
    }

    public function roomTypeEdit(RoomType $roomType)
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        return view('admin.room.room-types.edit-room-type', compact('roomType', 'admin'));
    }


    public function roomTypeUpdate(Request $request, RoomType $roomType)
    {
        $id = Auth::user()->id;
        $admin = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $roomType->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.room-list', compact('admin'))->with('success', 'Room type updated successfully');
    }

    public function destroy(RoomType $roomType)
    {
        $hasRooms = Room::where('room_type_id', $roomType->id)->exists();

        if ($hasRooms) {
            return redirect()->back()->with('error', 'Room type cannot be deleted as it has associated rooms.');
        }

        $roomType->delete();

        return redirect()->back()->with('success', 'Room type deleted successfully');
    }
}
