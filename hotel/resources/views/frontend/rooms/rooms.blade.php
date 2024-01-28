<section class="rooms-container">
    <h2 class="section-title-main">Rooms</h2>
    <div class="rooms-container__cards">
        @foreach ($randomRooms as $room)
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
                        <div>
                            <div class="card--room-info"><i class='bx bx-euro card-bx'></i> {{ $room->price }} / night
                            </div>
                            {{-- <div class="card--room-name"><i class='bx bx-bed card-bx'></i> {{ $room->bed_style }}</div> --}}
                            {{-- <div class="card--room-name"><i class='bx bx-male-female card-bx'></i>
                                {{ $room->total_adult }}
                            </div> --}}
                            {{-- <div class="card--room-name"><i class='bx bx-child card-bx'></i> {{ $room->total_child }}
                            </div> --}}
                        </div>
                        {{-- <div class="room-description">{{ $room->room_short_desc }}</div> --}}
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>
