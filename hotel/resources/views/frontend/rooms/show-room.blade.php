@extends('frontend.main-content')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @include('frontend.body.header')
    <h1 class="rooms-section-title">{{ $room->room_name }} </h1>

    <div class="check-in-showroom">
        <form action="{{ route('frontend.reservation', ['room' => $room]) }}" method="get" id="booking_form">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <div class="booking-page-left-side">
                <div class="checkin-data">
                    <div class="check-in-date check">
                        <div class="check-label">Check-in date</div>
                        <input autocomplete="off" type="date" name="check_in" class="check-input" id="check_in"
                            value="{{ request()->input('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="check-out-date check">
                        <div class="check-label">Check-out date</div>
                        <input autocomplete="off" type="date" name="check_out" class="check-input" id="check_out"
                            value="{{ request('check_out', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}"
                            required>
                    </div>
                    <div class="guest check">
                        <div class="check-label">Guest (Adult)</div>
                        <select name="person_adult" class="check-input guest-input">
                            @for ($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}"
                                    {{ request()->input('person_adult', 1) == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="guest check">
                        <div class="check-label">Guest (Child)</div>
                        <select name="person_child" class="check-input guest-input">
                            @for ($i = 0; $i <= 6; $i++)
                                <option value="{{ $i }}"
                                    {{ request()->input('person_child', 0) == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="total-data">
                    <table class="reservation-table">
                        <tbody>
                            <tr class="each-table-line">
                                <td class="table-leftside">Night:</td>
                                <td class="table-rightside"><span class="count">x</span><span
                                        class="table_total_night">1</span></td>
                            </tr>
                            <tr>
                                <td class="table-leftside">One Night:</td>
                                <td class="table-rightside"><span class="table_price_per_night">{{ $room->price }}</span>
                                    <i class='bx bx-euro reservation-bx'></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-leftside">In Total:</td>
                                <td class="table-rightside"><span class="table_total_price">0</span> <i
                                        class='bx bx-euro reservation-bx'></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <button type="submit" class="checkin-button">BOOK NOW</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="room-photo-gallery">
        @if (count($room->gallery) > 0)
            <div class="photo-gallery">
                @foreach ($room->gallery as $key => $photo)
                    <img src="{{ asset('/upload/room_photos') . '/' . $photo->room_photo }}" class="show-room-photo"
                        alt="room-{{ $key + 1 }}">
                @endforeach
            </div>
        @else
            <div class="photo-gallery">
                <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="show-room-photo" alt="room-1">
            </div>
        @endif
    </div>

    <div class="room-info">
        <p>
            <i class='bx bx-male-female'></i>
            Adult {{ $room->total_adult }}
        </p>
        <p>
            <i class='bx bxs-hotel'></i>
            {{ $room->bed_style }} bed
        </p>
        @if ($room->total_child > 0)
            <p>
                <i class='bx bx-child'></i>
                Child{{ $room->total_child }}
                ({{ $room->extra_child_bed }} extra bed)
            </p>
        @endif
        <p>
            <i class='bx bx-euro card-bx'></i>
            {{ $room->price }}
        </p>
        {{-- Make visible if the user has booked this room --}}
        {{-- <a href="{{ route('testimonials.create') }}">Feedback</a> --}}
    </div>
    <p class="long-description"><b>About room:</b> {{ $room->room_description }}</p>
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
