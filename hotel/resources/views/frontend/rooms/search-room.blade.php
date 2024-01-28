@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    <section class="search-room-container">
        <div class="check-in-out-form">
            <form action="{{ route('booking.search') }}" method="get" class="show-room__form form-search">
                @csrf
                <div class="check-in">
                    <label>Check-in date</label>
                    <input autocomplete="off" type="date" name="check_in" class="" id="check_in"
                        value="{{ request()->input('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="check-in">
                    <label>Check-out date</label>
                    <input autocomplete="off" type="date" name="check_out" class="" id="check_out"
                        value="{{ request('check_out', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}"
                        required>
                </div>
                <div class="check-in">
                    <label>Guest (Adult)</label>
                    <select name="person_adult" class="">
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}"
                                {{ request()->input('person_adult', 1) == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="check-in">
                    <label>Guest (Child)</label>
                    <select name="person_child" class="">
                        @for ($i = 0; $i <= 6; $i++)
                            <option value="{{ $i }}"
                                {{ request()->input('person_child', 0) == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="show-room-btn search-btn">BOOK NOW</button>
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
                                <div class=""><i class='bx bx-euro'></i> {{ $room->price }}
                                </div>
                                <div class=""><i class='bx bx-bed'></i> {{ $room->bed_style }}
                                </div>
                                <div class=""><i class='bx bx-male-female'></i>
                                    {{ $room->total_adult }}
                                </div>
                                <div class=""><i class='bx bx-child'></i>
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
