@extends('admin.admin-dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Create a New Room
    </h1>

    <div class="book-area-container">
        <form method="post" action="{{ route('admin.room-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="book-label">Room Name</label>
                <input type="text" id="room_name" name="room_name" class="form-control" required>
            </div>
            <div class="room-selection">
                <div>
                    <label class="book-label">Room Type: </label>
                    <select class="form-select" name="room_type_id">
                        <option value="0">Select a room type</option>
                        @foreach ($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="display-inline">
                <!-- Total Adult -->
                <div class="form-group">
                    <label class="book-label">Total Adult:</label>
                    <input type="number" id="total_adult" name="total_adult" class="form-control" required>
                </div>
                <!-- Total Child -->
                <div class="form-group">
                    <label class="book-label">Total Child:</label>
                    <input type="number" id="total_child" name="total_child" class="form-control" required>
                </div>
            </div>

            <div class="display-inline">
                <!-- Room Price -->
                <div class="form-group">
                    <label class="book-label">Price: <span class="currency"></span></label>
                    <input type="text" id="price" name="price" class="form-control" required>
                </div>
                <!-- Room Size -->
                <div class="form-group">
                    <label class="book-label">Room Size: <span class="square-meter"></span></label>
                    <input type="number" id="size" name="size" class="form-control" required>
                </div>

            </div>
            <div class="display-inline">
                <!-- Room Capacity -->
                <div class="form-group">
                    <label class="book-label">Room Capacity:</label>
                    <input type="number" id="room_capacity" name="room_capacity" value="1" class="form-control"
                        required>
                </div>
                <!-- Bed Style -->
                <div class="form-group">
                    <label class="book-label">Bed Style:</label>
                    <select name="bed_style" class="form-select" required>
                        <option value="0">Select Bed Style</option>
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="couch">Couch</option>
                    </select>
                </div>
            </div>
            <div class="display-inline">
                <!-- Discount -->
                <div class="form-group">
                    <label class="book-label">Discount: <span class="discount"></span></label>
                    <input type="text" id="discount" name="discount" value="0" class="form-control" required>
                </div>
                <!-- Room Availability -->
                <div class="form-group">
                    <label class="book-label">Room Availability:</label>
                    <select name="room_availability" class="form-select" required>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

            </div>
            <div class="display-inline">
                <!-- Short Description -->
                <div class="form-group">
                    <label class="book-label">Short Description:</label>
                    <textarea class="form-control" id="room_short_desc" name="room_short_desc" rows="3" placeholder="Description"
                        required></textarea>
                </div>
                <!-- Long Description -->
                <div class="form-group">
                    <label class="book-label">Long Description:</label>
                    <textarea class="form-control" id="room_description" name="room_description" rows="3" placeholder="Description"
                        required></textarea>
                </div>
            </div>

            <!-- Room Photo Upload -->
            <div class="form-group book-area-photo">
                <label class="book-label">Room Photo:</label>
                <input type="file" name="photo" id="photo" class="form-control-file">
                <img id="showImage"
                    src="{{ !empty($room->photo) ? url('upload/bookarea/' . $room->photo) : url('upload/noimage.jpg') }}"
                    class="main-review-img" alt="room photo">
            </div>

            <!-- Upload Room Photo Gallery -->
            <div class="mb-3 gallery-col" data-gallery="0">
                <label class="form-label"> <span class="rem">X</span> Gallery photo</label>
                <input type="file" class="form-control" name="room_photo">
            </div>

            <div class="gallery-inputs">

            </div>

            <button type="button" class="btn-add-gallery --add--gallery">Add gallery photo</button>

            <button type="submit" class="btn btn-primary">Create Room</button>
        </form>
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
