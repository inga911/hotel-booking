@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    @include('frontend.body.messages')
    <section class="rooms-container all-rooms-container">
        <h3 class="section-title-main">All Rooms</h3>
        @php
            $activeRoomsCount = $roomList->where('status', 'active')->count();
        @endphp
        <div class="search-result">Total: {{ $activeRoomsCount }} rooms</div>

        <div class="sort-rooms">
            <form action="{{ route('frontend.show.all.room') }}" method="get">
                <label for="sort">Sort</label>
                <select class="form-select" name="sort">
                    @foreach ($sortRoom as $value => $text)
                        <option value="{{ $value }}" @if ($value === $sort) selected @endif>
                            {{ $text }}</option>
                    @endforeach
                </select>

                <label for="filter">Filter</label>
                <select class="form-select" name="filter">
                    @foreach ($filterRoom as $value => $text)
                        <option value="{{ $value }}" @if ($value === $filter) selected @endif>
                            {{ $text }}</option>
                    @endforeach
                </select>

                <button type="submit">SORT</button>
                <a href="{{ route('frontend.show.all.room') }}">CLEAR</a>
            </form>
        </div>
        <div class="rooms-container__cards">
            @foreach ($roomList as $room)
                @if ($room->status == 'active')
                    <div class="card">
                        <a href="{{ route('frontend.show.room', $room) }}" class="card--link">
                            @if ($room->photo)
                                <img src="{{ asset('/upload/room_photos') . '/' . $room->photo }}" class="card--img"
                                    alt="room-1">
                            @else
                                <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="card--img" alt="room-1">
                            @endif
                            <div class="card--room-name">{{ $room->room_name }}</div>
                            <div class="card--room-details">
                                <div class="info"><i class='bx bx-euro card-bx'></i> {{ $room->price }}</div>
                                <div class="info"><i class='bx bx-bed card-bx'></i> {{ $room->bed_style }}</div>
                                <div class="info"><i class='bx bx-male-female card-bx'></i>
                                    {{ $room->total_adult }}
                                </div>
                                <div class="info"><i class='bx bx-child card-bx'></i> {{ $room->total_child }}
                                </div>
                            </div>
                            <div class="description">{{ $room->room_short_desc }}</div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
