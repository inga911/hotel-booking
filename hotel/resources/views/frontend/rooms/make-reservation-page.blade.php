@extends('frontend.main-content')

@section('content')
    @include('frontend.body.errors')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <form action="{{ route('frontend.payment.store', ['room' => $room]) }}" method="post" role="form">
        @csrf

        @if (isset($userRegistrationData))
            <input type="hidden" name="name" value="{{ $userRegistrationData['name'] }}">
            <input type="hidden" name="last_name" value="{{ $userRegistrationData['last_name'] }}">
            <input type="hidden" name="company_name" value="{{ $userRegistrationData['company_name'] }}">
            <input type="hidden" name="address" value="{{ $userRegistrationData['address'] }}">
            <input type="hidden" name="town" value="{{ $userRegistrationData['town'] }}">
            <input type="hidden" name="country" value="{{ $userRegistrationData['country'] }}">
            <input type="hidden" name="email" value="{{ $userRegistrationData['email'] }}">
            <input type="hidden" name="phone" value="{{ $userRegistrationData['phone'] }}">
            <input type="hidden" name="post_code" value="{{ $userRegistrationData['post_code'] }}">
            <input type="hidden" name="room_id" value="{{ $room->id }}">
        @endif

        <h1 class="show-room-name-title">Make your reservation</h1>
        <div class="booking-page-container">
            <div class="personal-information">
                <div class="display-inline">
                    <div class="display-grid">
                        <label class="reservation-form-label">First Name</label>
                        <input type="text" name="name" id="name" class="reservation-form-input"
                            value="{{ \Auth::user()->name }}">
                    </div>
                    <div class="display-grid">
                        <label class="reservation-form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="reservation-form-input">
                    </div>
                </div>
                <div class="display-grid full-input">
                    <label class="reservation-form-label">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="reservation-form-input">
                </div>
                <div class="display-grid full-input">
                    <label class="reservation-form-label">Address</label>
                    <input type="text" name="address" id="address" value="{{ \Auth::user()->address }}"
                        class="reservation-form-input">
                </div>
                <div class="display-grid full-input">
                    <label class="reservation-form-label">Town / City</label>
                    <input type="text" name="town" id="town" class="reservation-form-input">
                </div>
                <div class="display-inline">
                    <div class="display-grid">
                        <label class="reservation-form-label">Country</label>
                        <div class="full-input">
                            <select name="country" id="country" class="reservation-form-input full-input">
                                <option value="Europe">Europe</option>
                                <option value="US">US</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Asia">Asia</option>
                            </select>
                        </div>
                    </div>
                    <div class="display-grid">
                        <label class="reservation-form-label">Post Code</label>
                        <input type="text" name="post_code" id="post_code" class="reservation-form-input">
                    </div>
                </div>
                <div class="display-inline">
                    <div class="display-grid">
                        <label class="reservation-form-label">Email Address</label>
                        <input type="text" name="email" id="email" value="{{ \Auth::user()->email }}"
                            class="reservation-form-input">
                    </div>
                    <div class="display-grid">
                        <label class="reservation-form-label">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ \Auth::user()->phone }}"
                            class="reservation-form-input">
                    </div>
                </div>

            </div>
            <div class="booking-details">

                <h3>{{ $room->room_name }}</h3>
                <div class="">
                    <div class="booking-info">
                        <div>Check-in date</div>
                        <input autocomplete="off" type="date" name="check_in" id="check_in"
                            class="reservation-form-input" value="{{ request()->input('check_in', date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="booking-info">
                        <div>Check-out date</div>
                        <input autocomplete="off" type="date" name="check_out" class="reservation-form-input"
                            value="{{ request()->input('check_out', date('Y-m-d', strtotime('+1 day'))) }}"
                            min="{{ date('Y-m-d') }}" id="check_out" readonly>
                    </div>
                    <div class="booking-info">
                        <div>Guest (Adult)</div>
                        <p class="reservation-form-input" id="person_adult">
                            {{ request()->input('person_adult', 1) }}
                        </p>
                    </div>
                    <div class="booking-info">
                        <div>Guest (Child)</div>
                        <p class="reservation-form-input" id="person_child">
                            {{ request()->input('person_child', 0) }}
                        </p>
                    </div>
                    <div>For changing the data <a
                            href="{{ route('frontend.show.room', ['room' => $room] + request()->query()) }}">click
                            here</a>
                    </div>
                    <table class="reservation-page-table">
                        <tbody>
                            <tr class="each-table-line">
                                <td class="table-leftside">Night:</td>
                                <td class="table-rightside"><span class="count">x</span><span
                                        class="table_total_night">1</span></td>
                            </tr>
                            <tr>
                                <td class="table-leftside">One Night:</td>
                                <td class="table-rightside"><span
                                        class="table_price_per_night">{{ $room->price }}</span>
                                    <i class='bx bx-euro reservation-bx'></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-leftside">In Total:</td>
                                <td class="table-rightside"><span class="table_total_price" id="total_price">0</span> <i
                                        class='bx bx-euro reservation-bx'></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

        <div class="payment-card">
            <div class="payment-box">
                <div class="payment-method">
                    <p>
                        <input type="radio" id="paypal" name="">
                        <label for="paypal">PayPal</label>
                    </p>
                    <p>
                        <input type="radio" id="cash-on-delivery" name="payment_method" value="cash">
                        <label for="cash-on-delivery">Cash On Delivery</label>
                    </p>
                </div>
                <button type="submit">Order</button>

            </div>
        </div>
    </form>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        let check_in = "{{ request()->input('check_in', date('Y-m-d')) }}";
        let check_out = "{{ request()->input('check_out', date('Y-m-d', strtotime('+1 day'))) }}";
        let room_price = parseFloat("{{ $room->price }}");

        updatePrice(check_in, check_out, room_price);

        $("#check_in, #check_out").on('change', function() {
            let check_in = $("#check_in").val();
            let check_out = $("#check_out").val();
            updatePrice(check_in, check_out, room_price);
        });
    });

    function updatePrice(check_in, check_out, room_price) {
        console.log('updatePrice function called');
        $.ajax({
            url: "{{ route('check.room.availability') }}",
            data: {
                room_id: "{{ $room->id }}",
                check_in: check_in,
                check_out: check_out
            },
            success: function(data) {
                let total_nights = calculateNights(check_in, check_out);
                let total_price = room_price * total_nights;

                $(".table_total_night").text(total_nights);
                $(".table_total_price").text(total_price.toFixed(2));
            }
        });
    }

    function calculateNights(check_in, check_out) {
        let checkInDate = new Date(check_in);
        let checkOutDate = new Date(check_out);
        let timeDifference = checkOutDate - checkInDate;
        let totalNights = Math.ceil(timeDifference / (1000 * 3600 * 24));
        return totalNights;
    }
</script>
