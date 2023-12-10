<section class="rooms-container">
    <h3 class="rooms-section-title">Rooms</h3>
    <div class="cards">
        @foreach ($randomRooms as $room)
            @if ($room->status == 'active')
                <div class="card">
                    <a href="{{ route('frontend.show.room', $room) }}" class="each-room-card-link">
                        @if ($room->photo)
                            <img src="{{ asset('/upload/room_photos') . '/' . $room->photo }}" class="room-card-img"
                                alt="room-1">
                        @else
                            <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="room-card-img" alt="room-1">
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
            @endif
        @endforeach
    </div>
</section>
