<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Testimonials;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index()
    {
        $bookArea = BookArea::all();
        $roomType = RoomType::all();
        $roomList = Room::all();
        $testimonials = Testimonials::all();
        $randomRooms = $roomList->shuffle()->take(4);
        $randomReview = $testimonials->shuffle()->take(3);
        return view('frontend.index', [
            'bookArea' => $bookArea,
            'roomType' => $roomType,
            'roomList' => $roomList,
            'testimonials' => $testimonials,
            'randomRooms' => $randomRooms,
            'randomReview' => $randomReview,
        ]);
    }


    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.user.edit-profile', compact('user'));
    }

    public function userStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();

        return redirect()->back();
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function userChangePassword()
    {
        return view('frontend.user.change-password');
    }

    public function userChangePasswordStore(Request $request)
    {
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        /// Update The New Password 
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);



        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back();
    }

    public function showRoom(Room $room)
    {
        return view('frontend.rooms.show-room', compact('room'));
    }

    public function bookingSearch(Request $request)
    {
        $request->flash();
        if ($request->check_in == $request->check_out) {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $startDate = date('Y-m-d', strtotime($request->check_in));
        $endDate = date('Y-m-d', strtotime($request->check_out));

        $allDate = Carbon::create($endDate)->subDay();
        $period = CarbonPeriod::create($startDate, $allDate);
        $date_array = [];
        foreach ($period as $p) {
            array_push($date_array, date('Y-m-d', strtotime($p)));
        }
    }
}
