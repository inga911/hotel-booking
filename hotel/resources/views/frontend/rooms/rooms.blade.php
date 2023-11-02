<section class="rooms-container">
    <h3 class="rooms-section-title">Rooms</h3>
    <div class="cards">
        @foreach ($randomRooms as $room)
            <div class="card">
                <a href="{{ route('frontend.show.room', $room) }}" class="each-room-card-link">
                    @if ($room->photo)
                        <img src="{{ asset('/upload/room_photos') . '/' . $room->photo }}" class="room-card-img"
                            alt="room-1">
                    @else
                        <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="room-card-img" alt="room-1">
                    @endif
                    <h4>{{ $room->room_name }}</h4>
                    <p class="room-description">{{ $room->room_short_desc }}</p>

                    {{-- Make visible if the user has booked this room --}}
                    {{-- <a href="{{ route('testimonials.create') }}">Feedback</a> --}}
                </a>
            </div>
        @endforeach
    </div>
</section>
