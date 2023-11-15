<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomBookedDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Stripe;
use Illuminate\Support\Facades\Validator;

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

            return redirect()->route('frontend.show.all.room', compact('userRegistrationData'))->with('success', 'Registration completed successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid booking data');
        }
    }
}
