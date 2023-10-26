<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\BookArea;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class RoomTypeController extends Controller
{
    public function roomTypeList()
    {
        $roomType = RoomType::all();

        return view('admin.room.room-types.room-type-view', compact('roomType'));
    }

    public function addRoomType()
    {
        return view('admin.room.room-types.add-room-type');
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
        return view('admin.room.room-types.edit-room-type', compact('roomType'));
    }


    public function roomTypeUpdate(Request $request, RoomType $roomType)
    {
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

        return redirect()->route('admin.room-list')->with('success', 'Room type updated successfully');
    }
}
