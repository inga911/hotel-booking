@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    <div class="reservation-container">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        {{-- <form action="{{ route('frontend.payment.store', ['room' => $room]) }}" method="post" role="form"
            class="stripe_form require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"> --}}
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
            <h1 class="reservation-title">Make your reservation</h1>
            <div class="reservations-forms">
                <div class="personal-information">
                    <div class="personal-information__field">
                        <label>First Name</label>
                        <input type="text" name="name" id="name" value="{{ \Auth::user()->name }}">
                        @error('name')
                            <span class="inline-text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="personal-information__field">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="last_name">
                        @error('last_name')
                            <span class="inline-text-error last-name-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="personal-information__field">
                        <label>Company Names</label>
                        <input type="text" name="company_name" id="company_name">
                    </div>
                    <div class="personal-information__field">
                        <label>Address</label>
                        <input type="text" name="address" id="address" value="{{ \Auth::user()->address }}">
                        @error('address')
                            <span class="inline-text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="personal-information__field">
                        <label>City</label>
                        <input type="text" name="town" id="town">
                    </div>
                    <div class="personal-information__field">
                        <label>Country</label>
                        <select name="country" id="country">
                            <option value="Europe">Europe</option>
                            <option value="US">US</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Asia">Asia</option>
                        </select>
                    </div>
                    <div class="personal-information__field">
                        <label>Post Code</label>
                        <input type="text" name="post_code" id="post_code">
                    </div>
                    <div class="personal-information__field">
                        <label>Email Address</label>
                        <input type="text" name="email" id="email" value="{{ \Auth::user()->email }}">
                        @error('email')
                            <span class="inline-text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="personal-information__field">
                        <label>Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ \Auth::user()->phone }}">
                        @error('phone')
                            <span class="inline-text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="booking-details">
                    <h1 class="booking-details__room-title"><i class='bx bx-chevron-right'></i> {{ $room->room_name }}</h1>
                    <div class="booking-info">
                        <div>Check-in date</div>
                        <input autocomplete="off" type="date" name="check_in" id="check_in"
                            value="{{ request()->input('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="booking-info">
                        <div>Check-out date</div>
                        <input autocomplete="off" type="date" name="check_out"
                            value="{{ request()->input('check_out', date('Y-m-d', strtotime('+1 day'))) }}"
                            min="{{ date('Y-m-d') }}" id="check_out" readonly>
                    </div>
                    <div class="booking-info">
                        <div>Guest (Adult)</div>
                        <p id="person_adult">
                            {{ request()->input('person_adult', 1) }}
                        </p>
                    </div>
                    <div class="booking-info">
                        <div>Guest (Child)</div>
                        <p id="person_child">
                            {{ request()->input('person_child', 0) }}
                        </p>
                    </div>
                    <div class="info-text">
                        If you want to change it
                        <a href="{{ route('frontend.show.room', ['room' => $room] + request()->query()) }}"
                            class="info-text__change-data">click
                            here</a>
                    </div>
                    <table>
                        <tr>
                            <th>Nights:</th>
                            <td><span class="count">x</span><span class="table_total_night">1</span></td>
                        </tr>
                        <tr>
                            <th>One Night:</th>
                            <td><span class="table_price_per_night">{{ $room->price }}</span>
                                <i class='bx bx-euro reservation-bx'></i>
                            </td>
                        </tr>
                        <tr>
                            <th>In Total:</th>
                            <td><span class="table_total_price" id="total_price">0</span>
                                <i class='bx bx-euro reservation-bx'></i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="payment-card">
                <div class="payment-method">
                    <input type="radio" checked id="cash-on-delivery" name="payment_method" value="cash">
                    <label for="cash-on-delivery">Cash On Delivery</label>
                </div>
                <div class="payment-method">
                    <input type="radio" onclick="showPayment()" id="stripe" name="payment_method" value="Stripe">
                    <label for="stripe">Stripe</label>
                </div>
                <div id="stripe_pay" class="stripe-card" style="display: none;">
                    <div class="card-name">
                        <label>Name on Card</label>
                        <input size="4" type="text" />
                    </div>
                    <div class="card-number">
                        <label>Card Number</label>
                        <input autocomplete="off" class="card-number-data-input" maxlength="4" pattern="[0-9]*"
                            inputmode="numeric" placeholder="xxxx" type="text" data-pattern-validate />
                        <input autocomplete="off" class="card-number-data-input" maxlength="4" pattern="[0-9]*"
                            inputmode="numeric" placeholder="xxxx" type="text" data-pattern-validate />
                        <input autocomplete="off" class="card-number-data-input" maxlength="4" pattern="[0-9]*"
                            inputmode="numeric" placeholder="xxxx" type="text" data-pattern-validate />
                        <input autocomplete="off" class="card-number-data-input" maxlength="4" pattern="[0-9]*"
                            inputmode="numeric" placeholder="xxxx" type="text" data-pattern-validate />
                    </div>
                    <div class="card-cvc">
                        <label>CVC</label>
                        <input autocomplete="off" class="reservation-form-input" size="4" type="text"
                            name="cvc" id="cvc" placeholder="ex. 311" pattern="[0-9]{3,4}" required>

                    </div>
                    <div class="expiration-date">
                        <label>Expiration date</label>
                        <div class="exp-wrapper">
                            <input autocomplete="off" class="exp" id="month" maxlength="2" pattern="[0-9]*"
                                inputmode="numeric" placeholder="MM" type="text" data-pattern-validate />
                            <input autocomplete="off" class="exp" id="year" maxlength="2" pattern="[0-9]*"
                                inputmode="numeric" placeholder="YY" type="text" data-pattern-validate />
                        </div>
                    </div>
                </div>
                <button class="reservation-button" type="submit" id="myButton">Order</button>
            </div>
        </form>
    </div>

    <script>
        function showPayment() {
            let x = document.getElementById("stripe_pay");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        };

        const cvcInput = document.querySelector('#cvc');
        cvcInput.addEventListener('input', (event) => {
            const value = event.target.value.toString();
            const numericValue = value.replace(/\D/g, '');
            event.target.value = numericValue;
        });

        const monthInput = document.querySelector('#month');
        const yearInput = document.querySelector('#year');

        const focusSibling = function(target, direction, callback) {
            const nextTarget = target[direction];
            nextTarget && nextTarget.focus();
            callback && callback(nextTarget);
        }

        function validateExpirationDate(expirationMonth, expirationYear) {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth() + 1;

            if (expirationYear > currentYear) {
                return true;
            } else if (expirationYear === currentYear && expirationMonth >= currentMonth) {
                return true;
            }

            return false;
        }

        monthInput.addEventListener('input', (event) => {
            const value = event.target.value.toString();
            if (value.length === 1 && value > 1) {
                event.target.value = "0" + value;
            }
            if (value === "00") {
                event.target.value = "01";
            } else if (value > 12) {
                event.target.value = "12";
            }
            2 <= event.target.value.length && focusSibling(event.target, "nextElementSibling",
                validateExpirationDate);
            event.stopImmediatePropagation();
        });

        yearInput.addEventListener('keydown', (event) => {
            if (event.key === "Backspace" && event.target.selectionStart === 0) {
                focusSibling(event.target, "previousElementSibling", validateExpirationDate);
                event.stopImmediatePropagation();
            }
        });

        const inputMatchesPattern = function(e) {
            const {
                value,
                selectionStart,
                selectionEnd,
                pattern
            } = e.target;

            const character = String.fromCharCode(e.which);
            const proposedEntry = value.slice(0, selectionStart) + character + value.slice(selectionEnd);
            const match = proposedEntry.match(pattern);

            return e.metaKey ||
                e.which <= 0 ||
                e.which == 8 ||
                (match && match[0] === match.input);
        };

        document.querySelectorAll('input[data-pattern-validate]').forEach(el => el.addEventListener('keypress', e => {
            if (!inputMatchesPattern(e)) {
                return e.preventDefault();
            }
        }));

        const cardNumberInputs = document.querySelectorAll('.card-number-data-input');

        cardNumberInputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                const value = event.target.value.toString();
                if (value.length === 4) {
                    if (index < cardNumberInputs.length - 1) {
                        cardNumberInputs[index + 1].focus();
                    }
                }
            });
        });


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
@endsection
