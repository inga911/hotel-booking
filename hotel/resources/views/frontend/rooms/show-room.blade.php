@extends('frontend.main-content')
@section('content')
    <h1 class="show-room-name-title">{{ $room->room_name }} </h1>
    <div class="show-room-card">
        @if (count($room->gallery) > 0)
            <div class="photo-gallery">
                @foreach ($room->gallery as $key => $photo)
                    <img src="{{ asset('/upload/room_photos') . '/' . $photo->room_photo }}" class="show-room-photo"
                        alt="room-{{ $key + 1 }}">
                @endforeach
            </div>
        @else
            <div class="photo-gallery no-background">
                <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="show-room-photo" alt="room-1">
            </div>
        @endif
    </div>
    </div>
    <div class="room-info">
        <p class=""><i class='bx bx-male-female'></i>Adult {{ $room->total_adult }}</p>
        <p class=""><i class='bx bxs-hotel'></i>{{ $room->bed_style }} bed</p>
        @if ($room->total_child > 0)
            <p class=""><i class='bx bx-child'></i>Child{{ $room->total_child }}
                ({{ $room->extra_child_bed }} extra bed)</p>
        @endif
        <p class=""><i class='bx bx-euro card-bx'></i>{{ $room->price }}</p>
        {{-- Make visible if the user has booked this room --}}
        {{-- <a href="{{ route('testimonials.create') }}">Feedback</a> --}}
    </div>
    <p class="long-description"><b>About room:</b> {{ $room->room_description }}</p>
@endsection
