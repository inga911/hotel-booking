@extends('admin.admin-dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Create a New Room
    </h1>
    @include('admin.body.errors')
    @include('admin.body.messages')

    <div class="create-room-container">
        <div class="book-area-container">
            <form method="post" action="{{ route('admin.room-store') }}" enctype="multipart/form-data">
                @csrf
                <div class="display-inline">
                    <div class="form-group">
                        <label class="book-label">Room Name</label>
                        <input type="text" id="room_name" name="room_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="book-label">Room Number</label>
                        <input type="text" id="room_number" name="room_number" class="form-control">
                    </div>
                </div>
                <div class="display-inline">
                    <div>
                        <label class="book-label">Room Type: </label>
                        <select class="form-select" name="room_type_id">
                            <option value="0">Select a room type</option>
                            @foreach ($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="book-label">Room Status: </label>
                        <select name="status" class="form-select">
                            <option value="0">Select room status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="display-inline">
                    <!-- Total Adult -->
                    <div class="form-group">
                        <label class="book-label">Total Adult:</label>
                        <input type="number" id="total_adult" name="total_adult" class="form-control">
                    </div>
                    <!-- Total Child -->
                    <div class="form-group">
                        <label class="book-label">Total Child:</label>
                        <input type="number" id="total_child" name="total_child" class="form-control">
                    </div>
                </div>
                <div class="display-inline">
                    <!-- Bed Style -->
                    <div class="form-group">
                        <label class="book-label">Bed Style:</label>
                        <select name="bed_style" class="form-select">
                            <option value="0">Select Bed Style</option>
                            <option value="single">Single Bed</option>
                            <option value="double">Double Bed</option>
                            <option value="king">King Bed</option>
                        </select>
                    </div>
                    <!-- Extra Child Bed -->
                    <div class="form-group">
                        <label class="book-label">Extra Bed Style: <span style="font-size: 11px">(1 child = 1 extra single
                                bed)</span></label>
                        <select name="extra_child_bed" class="form-select">
                            <option value="0">Select Bed Style</option>
                            <option value="1">1 kid bed</option>
                            <option value="2">2 kid bed</option>
                            <option value="3">3 kid bed</option>
                        </select>
                    </div>
                </div>

                <div class="display-inline">
                    <!-- Short Description -->
                    <div class="form-group">
                        <label class="book-label">Short Description:</label>
                        <textarea class="form-control description-form" id="room_short_desc" name="room_short_desc" rows="3"
                            placeholder="Description"></textarea>
                    </div>
                    <!-- Price -->
                    <div class="form-group">
                        <label class="book-label">Price: <span class="currency"></span></label>
                        <input type="text" id="price" name="price" class="form-control">
                    </div>
                </div>
                <!-- Long Description-->
                <div class="form-group">
                    <label class="book-label">Long Description:</label>
                    <textarea class="form-control description-form" id="room_description" name="room_description" rows="3"
                        placeholder="Description"></textarea>
                </div>
                <!-- Room Photo Upload -->
                <div class="form-group book-area-photo">
                    <label class="book-label">Room Photo:</label>
                    <input type="file" name="photo" id="photo" class="form-control-file">
                    <img id="showImage"
                        src="{{ !empty($room->photo) ? url('upload/room_photos/' . $room->photo) : url('upload/noimage.jpg') }}"
                        class="main-review-img" alt="room photo">
                </div>
                <!-- Upload Room Photo Gallery -->
                <div class="mb-3 gallery-col" data-gallery="0">
                    <label class="form-label"> <span class="rem">X</span> Gallery photo</label>
                    <input type="file" class="form-control" id="photo" name="room_photo" multiple>
                </div>
                <div class="gallery-inputs">
                </div>
                <button type="button" class="btn-add-gallery --add--gallery">Add gallery photo</button>
                <button type="submit" class="btn btn-primary">Create Room</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        if (document.querySelector('.--add--gallery')) {
            let galleryInput = 0;
            document.querySelector('.--add--gallery')
                .addEventListener('click', _ => {
                    const input = document.querySelector('[data-gallery="0"]').cloneNode(true);
                    galleryInput++;
                    input.dataset.gallery = galleryInput;
                    input.querySelector('input').setAttribute('name', 'gallery[]');
                    input.querySelector('span')
                        .addEventListener('click', e => {
                            e.target.closest('.mb-3').remove();
                        });
                    document.querySelector('.gallery-inputs').append(input);
                });
        }
    </script>
@endsection
