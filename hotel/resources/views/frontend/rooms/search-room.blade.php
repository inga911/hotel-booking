@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    <section class="search-room-container">
        <div class="check-in-out-form">
            <form action="{{ route('booking.search') }}" method="get" class="show-room__form form-search">
                @csrf
                <div class="check-in">
                    <label>Check-in date</label>
                    <input autocomplete="off" type="date" name="check_in" id="check_in"
                        value="{{ request()->input('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="check-in">
                    <label>Check-out date</label>
                    <input autocomplete="off" type="date" name="check_out" id="check_out"
                        value="{{ request('check_out', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}"
                        required>
                </div>
                <div id="adultsCounter" class="check-in">
                    <label>Adult</label>
                    <div class="counter">
                        <button type="button" id="decreaseAdults" class="counter-btn"><i class='bx bx-minus'></i></button>
                        <input type="text" id="adultsNumber" name="person_adult" value="1" class="counter-input"
                            readonly>
                        <button type="button" id="increaseAdults" class="counter-btn"><i class='bx bx-plus'></i></button>
                    </div>
                </div>

                <div id="childCounter" class="check-in">
                    <label>Child</label>
                    <div class="counter">
                        <button type="button" id="decreaseChild" class="counter-btn"><i class='bx bx-minus'></i></button>
                        <input type="text" id="childNumber" name="person_child" value="0" class="counter-input"
                            readonly>
                        <button type="button" id="increaseChild" class="counter-btn"><i class='bx bx-plus'></i></button>
                    </div>
                </div>
                <button type="submit" class="show-room-btn search-btn">SEARCH</button>
            </form>
        </div>

        <div class="search-result-info">
            @php
                $availableRoomsCount = $rooms
                    ->filter(function ($room) {
                        return $room->status == 'active' && $room->isAvailableToday();
                    })
                    ->count();
            @endphp

            We can offer you {{ $availableRoomsCount }} rooms according to your request
        </div>
        <div class="found-room-cards">
            @forelse ($rooms as $room)
                @if ($room->status == 'active' && $room->isAvailableToday())
                    <a href="{{ route('frontend.show.room', ['room' => $room] + request()->query()) }}"
                        class="found-room-link">
                        @if ($room->photo)
                            <img src="{{ asset('/upload/room_photos') . '/' . $room->photo }}" class="found-room-img"
                                alt="{{ $room->room_name }}">
                        @else
                            <img src="{{ asset('/upload/noimage.jpg') }}" class="found-room-img" alt="room-1">
                        @endif
                        <div class="found-room-details">
                            <div class="found-room-details__name">{{ $room->room_name }}</div>
                            <div class="found-room-details__info">
                                <div><i class='bx bx-euro'></i> {{ $room->price }}
                                </div>
                                <div><i class='bx bx-bed'></i> {{ $room->bed_style }}
                                </div>
                                <div><i class='bx bx-male-female'></i>
                                    {{ $room->total_adult }}
                                </div>
                                <div><i class='bx bx-child'></i>
                                    {{ $room->total_child }}
                                </div>
                            </div>
                            <div class="found-room-details__description">{{ $room->room_short_desc }}</div>
                        </div>
                    </a>
                @endif
            @empty
                <div>No rooms available for the selected dates and number of PERSONS.</div>
            @endforelse
        </div>
    </section>
@endsection
