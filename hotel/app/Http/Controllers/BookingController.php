<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirm;
use App\Models\Booking;
use App\Models\BookingRoomList;
use App\Models\Room;
use App\Models\RoomBookedDate;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Stripe;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Notifications\BookingComplete;
use Illuminate\Support\Facades\Notification;


class BookingController extends Controller
{
    public function makeReservation(Room $room)
    {

        $userRegistrationData = Session::get('user_registration_data');

        Session::put('book_date', [
            'check_in' => request()->input('check_in'),
            'check_out' => request()->input('check_out'),
            'total_adult' => request()->input('person_adult', 1),
            'total_child' => request()->input('person_child', 0),
        ]);

        return view('frontend.rooms.make-reservation-page', compact('room', 'userRegistrationData'));
    }


    public function reservationStore(Request $request, Room $room)
    {
        $searchData = request()->query();
        return redirect()->route('frontend.reservation', compact('searchData'));
    }



    public function paymentStore(Request $request, Room $room)
    {

        $user = User::where('role', 'admin')->get();
        // dd(env('STRIPE_SECRET'));
        $room_price = $room->price;
        // dd($room->price);
        $userRegistrationData = Session::get('user_registration_data');

        $book_data = Session::get('book_date') ?? [];

        if (isset($book_data['check_in']) && isset($book_data['check_out'])) {
            $fromDate = Carbon::parse($book_data['check_in']);
            $toDate = Carbon::parse($book_data['check_out']);
            $total_night = $fromDate->diffInDays($toDate);
            $total_price = $total_night * $room_price;

            $code = rand(000000000, 999999999);

            // if ($request->payment_method == 'stripe') {
            //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            //     $stripe_pay = Stripe\Charge::create([
            //         "amount" => $total_price * 100,
            //         "currency" => "eur",
            //         "source" => $request->stripeToken,
            //         "description" => "Payment for booking. Booking No " . $code,
            //     ]);

            //     if ($stripe_pay['status'] == 'succeeded') {
            //         $payment_status = 1;
            //         $transation_id = $stripe_pay->id;
            //     } else {

            //         $notification = array(
            //             'message' => 'Sorry Payment Field',
            //             'alert-type' => 'error'
            //         );
            //         return redirect('/')->with($notification);
            //     }
            // } else {
            //     $payment_status = 0;
            //     $transation_id = '';
            // }
            $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string',
                'company_name' => 'sometimes',
                'email' => 'required|email',
                'phone' => ['required', 'regex:/^[+]*[0-9]{9}$/'],
                'country' => 'sometimes',
                'post_code' => 'sometimes',
                'address' => 'required',
                'town' => 'sometimes',
            ], [
                'phone.regex' => 'The phone number must consist of 9 digits and contain only numbers (0-9).',
            ]);


            $data = new Booking();
            $data->room_id = $room->id;
            $data->user_id = Auth::user()->id;
            $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
            $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));

            $data->total_adult = isset($book_data['total_adult']) ? $book_data['total_adult'] : 0;
            $data->total_child = isset($book_data['total_child']) ? $book_data['total_child'] : 0;

            $data->total_night = $total_night;
            $data->total_price = $total_price;
            $data->payment_method = $request->payment_method;

            $data->transation_id = '';
            $data->payment_status = 0;

            $data->name = Auth::user()->name  ?? $request->input('name', '');
            $data->last_name =  Auth::user()->last_name ?? $request->input('last_name', '');
            $data->company_name =  Auth::user()->company_name ?? $request->input('company_name', '');
            $data->email = Auth::user()->email ?? $request->input('email', '');
            $data->phone = Auth::user()->phone ?? $request->input('phone', '');
            $data->country =  Auth::user()->country ?? $request->input('country', '');
            $data->post_code =  Auth::user()->post_code ?? $request->input('post_code', '');
            $data->address = Auth::user()->address ?? $request->input('address', '');
            $data->town =  Auth::user()->town ?? $request->input('town', '');

            $data->code = $code;
            $data->status = 0;
            $data->created_at = Carbon::now();
            $data->save();

            $sdate = date('Y-m-d', strtotime($book_data['check_in']));
            $edate = date('Y-m-d', strtotime($book_data['check_out']));
            $eldate = Carbon::create($edate)->subDay();
            $d_period = CarbonPeriod::create($sdate, $eldate);

            foreach ($d_period as $period) {
                $booked_dates = new RoomBookedDate();
                $booked_dates->booking_id = $data->id;
                $booked_dates->room_id = $room->id;
                $booked_dates->book_date = date('Y-m-d', strtotime($period));
                $booked_dates->save();
            }

            Session::forget('user_registration_data');
            Session::forget('book_date');

            $bookingId = $data->id;
            $roomIds = [$room->id];
            $roomNumber = $room->room_number;


            foreach ($roomIds as $roomId) {
                BookingRoomList::create([
                    'booking_id' => $bookingId,
                    'room_id' => $roomId,
                    'room_number' => $roomNumber,
                ]);
            }

            Notification::send($user, new BookingComplete($request->name));

            return redirect()->route('frontend.show.all.room', compact('userRegistrationData'))->with('success', 'Your registration has been completed successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid booking data');
        }
    }

    //Booking List (admin)
    public function bookingList(Request $request)
    {
        $id = Auth::user()->id;
        $admin = User::find($id);

        $query = Booking::query();

        $searchTerm = $request->input('search');
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('code', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('status', 'LIKE', "%{$searchTerm}%");
                if ($searchTerm == 'pending') {
                    $query->orWhere('status', 0);
                } elseif ($searchTerm == 'active') {
                    $query->orWhere('status', 1);
                } elseif ($searchTerm == 'done') {
                    $query->orWhere('status', 2);
                }
            });
        }

        $allBookingData = $query->orderBy('id', 'desc')->paginate(10);

        foreach ($allBookingData as $booking) {
            $booking->totalGuests = $booking->total_adult + $booking->total_child;
        }

        return view('admin.booking.booking-list', compact('allBookingData', 'admin'));
    }

    public function bookingEdit($id)
    {
        $admin = Auth::user();
        $bookingEditData = Booking::with('room')->find($id);

        return view('admin.booking.booking-edit', compact('bookingEditData', 'admin'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $bookingUpdate = Booking::find($id);
        $bookingUpdate->payment_status = $request->payment_status;
        $bookingUpdate->status = $request->status;
        $bookingUpdate->save();

        $sendMail = Booking::find($id);
        $mailData = [
            'check_in' => $sendMail->check_in,
            'check_out' => $sendMail->check_out,
            'name' => $sendMail->ame,
            'email' => $sendMail->email,
            'phone' => $sendMail->phone,
        ];

        Mail::to($sendMail->email)->send(new BookingConfirm($mailData));

        $notification = array(
            'success' => 'Information Updated Successfully'
        );
        return redirect()->back()->with($notification);
    }

    public function updateCheckInOut(Request $request, $id)
    {
        $checkInOutUpdate = Booking::find($id);

        $newCheckIn = $request->check_in;
        $newCheckOut = $request->check_out;

        $fromDate = Carbon::parse($newCheckIn);
        $toDate = Carbon::parse($newCheckOut);
        $totalNights = $fromDate->diffInDays($toDate);

        $roomPrice = $checkInOutUpdate->room->price;
        $newTotalPrice = $totalNights * $roomPrice;

        $checkInOutUpdate->check_in = $newCheckIn;
        $checkInOutUpdate->check_out = $newCheckOut;
        $checkInOutUpdate->total_night = $totalNights;
        $checkInOutUpdate->total_price = $newTotalPrice;

        $checkInOutUpdate->save();

        $notification = array(
            'success' => 'Information Updated Successfully'
        );

        return redirect()->back()->with($notification);
    }


    //USER BOOKING
    public function userBooking()
    {
        $id = Auth::user()->id;
        $allUserBookingData = Booking::where('user_id', $id)->orderBy('id', 'desc')->paginate(3);
        return view('frontend.user.user-reservation', compact('allUserBookingData'));
    }

    public function userInvoice($id)
    {
        $allUserBookingData = Booking::with('room')->find($id);
        $pdf = Pdf::loadView('frontend.rooms.pdf-invoice', compact('allUserBookingData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('booking-invoice.pdf');
    }
}
