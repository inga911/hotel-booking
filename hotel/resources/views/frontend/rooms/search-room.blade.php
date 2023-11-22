@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    <section class="rooms-container">

        <div class="check-in-out-form">
            <form action="{{ route('booking.search') }}" method="get">
                @csrf
                <div class="search-room-check-form">
                    <div class="check-in-date check">
                        <div class="check-label">Check-in date</div>
                        <input autocomplete="off" type="date" name="check_in" class="check-input"
                            value="{{ request()->input('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="check-out-date check">
                        <div class="check-label">Check-out date</div>
                        <input autocomplete="off" type="date" name="check_out" class="check-input"
                            value="{{ request()->input('check_out', date('Y-m-d', strtotime('+1 day'))) }}"
                            min="{{ date('Y-m-d') }}" required>
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
                    <div>
                        <button type="submit" class="checkin-button available-rooms-btn">Check Availability</button>
                    </div>
                </div>
            </form>

        </div>

        <h3 class="rooms-section-title">Available Rooms</h3>
        <div class="cards">
            @forelse ($rooms as $room)
                @if ($room->status == 'active')
                    <div class="card">
                        <a href="{{ route('frontend.show.room', ['room' => $room] + request()->query()) }}"
                            class="each-room-card-link">
                            @if ($room->photo)
                                <img src="{{ asset('/upload/room_photos') . '/' . $room->photo }}" class="room-card-img"
                                    alt="{{ $room->room_name }}" width="200px">
                            @else
                                <img src="{{ asset('/upload/noimage.jpg') }}" class="room-card-img" alt="room-1">
                            @endif
                            <div class="room-name-card">{{ $room->room_name }}</div>
                            <div class="room-card-details">
                                <div class="room-name-card"><i class='bx bx-euro card-bx'></i> {{ $room->price }}</div>
                                <div class="room-name-card"><i class='bx bx-bed card-bx'></i> {{ $room->bed_style }}</div>
                                <div class="room-name-card"><i class='bx bx-male-female card-bx'></i>
                                    {{ $room->total_adult }}
                                </div>
                                <div class="room-name-card"><i class='bx bx-child card-bx'></i> {{ $room->total_child }}
                                </div>
                            </div>
                            <div class="room-description">{{ $room->room_short_desc }}</div>
                        </a>
                    </div>
                @else
                    <div>No rooms available for the selected dates and number of PERSONS.</div>
                @endif
            @empty
                <div>No rooms available for the selected dates and number of persons.</div>
            @endforelse
        </div>
    </section>
@endsection
