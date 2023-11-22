<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Room;
use App\Models\RoomBookedDate;
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => ['required', 'regex:/^[0-9]{9}$/'],
            'address' => 'required',
        ], [
            'phone.regex' => 'The phone number must consist of 9 digits and contain only numbers (0-9).',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();


        $notification = [
            'message' => 'Profile information updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function userChangePassword()
    {
        return view('frontend.user.change-password');
    }

    public function userChangePasswordStore(Request $request)
    {
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

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }


    public function showRoom(Room $room)
    {
        $searchData = request()->query();
        $bookDateArray = session('book_date');
        return view('frontend.rooms.show-room', compact('room', 'searchData'));
    }


    public function showAllRoom()
    {
        $roomType = RoomType::all();
        $roomList = Room::all();
        $testimonials = Testimonials::all();
        return view('frontend.rooms.all-rooms', [
            'roomType' => $roomType,
            'roomList' => $roomList,
            'testimonials' => $testimonials,
        ]);
    }

    public function bookingSearch(Request $request, Room $room)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'person_adult' => 'required|integer|min:0',
            'person_child' => 'required|integer|min:0',
        ]);

        if ($request->check_in == $request->check_out) {
            return redirect()->back();
        }

        $startDate = date('Y-m-d', strtotime($request->check_in));
        $endDate = date('Y-m-d', strtotime($request->check_out));

        $allDate = Carbon::create($endDate)->subDay();
        $period = CarbonPeriod::create($startDate, $allDate);
        $date_array = [];

        foreach ($period as $p) {
            array_push($date_array, date('Y-m-d', strtotime($p)));
        }

        $checkBookingDateId = RoomBookedDate::whereIn('book_date', $date_array)->distinct()->pluck('booking_id')->toArray();

        $personAdult = $request->input('person_adult');
        $personChild = $request->input('person_child');

        $rooms = Room::where('status', 'active')
            ->whereNotIn('id', $checkBookingDateId)
            ->where(function ($query) use ($personAdult, $personChild) {
                $query->where('total_adult', $personAdult)->where('total_child', $personChild);
            })
            ->orWhere(function ($query) use ($personAdult, $personChild) {
                $query->where('total_adult', '=', $personAdult)->where('total_child', '=', $personChild);
            })
            ->get();

        return view('frontend.rooms.search-room', compact('rooms', 'checkBookingDateId'));
    }

    public function checkRoomAvailability(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->check_in);
            $endDate = Carbon::parse($request->check_out);

            $date_array = [];
            $period = Carbon::create($startDate)->daysUntil($endDate);
            foreach ($period as $date) {
                $date_array[] = $date->format('Y-m-d');
            }

            $checkBookingDateId = RoomBookedDate::whereIn('book_date', $date_array)->distinct()->pluck('booking_id')->toArray();

            $room = Room::withCount('room_numbers')->find($request->room_id);

            $bookings = Booking::withCount('assign_rooms')->whereIn('id', $checkBookingDateId)->where('rooms_id', $room->id)->get()->toArray();

            $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));

            $available_room = max(0, $room->room_numbers_count - $total_book_room);

            $nights = $startDate->diffInDays($endDate);

            return response()->json(['available_room' => $available_room, 'total_nights' => $nights]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred']);
        }
    }

    //CONTACT
    public function contact()
    {
        return view('frontend.contact.contact-us');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'subject' => 'required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'success' => 'Your message was sent successfully'
        );
        return redirect()->back()->with($notification);
    }
}
