@extends('frontend.main-content')
@section('content')
    <h1 class="main-title">
        <i class='bx bxs-chevron-right'></i>
        here will be CREATE REVIEW page
    </h1>

    <div class="create-review-container">
        <form method="post" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group">
                <label class="review-label>Room Name</label>
                <input type="text" id="room_name" name="room_name" class="form-control" required>
            </div> --}}
            {{-- <div class="room-selection">
                <div>
                    <label class="review-label">Room Type: </label>
                    <select class="form-select" name="room_type_id">
                        <option value="0">Select a room type</option>
                        @foreach ($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}



            <!-- Long Description -->
            <div class="form-group">
                <label class="review-label">Your opinion:</label>
                <textarea class="form-control" id="review" name="review" rows="3" placeholder="Description" required></textarea>
            </div>
            <div class="form-group">
                <label class="review-label">Author Name</label>
                <input type="text" id="author_name" name="author_name" class="form-control" value="{{ $user->name }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Create Room</button>
        </form>
    </div>
@endsection
