@extends('admin.admin-dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        EDIT room <i>{{ $room->room_name }}</i>
    </h1>
    @include('admin.body.errors')
    @include('admin.body.messages')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-primary" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                            </div>
                            <div class="tab-title">Room Details</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#primaryphotos" role="tab" aria-selected="false"
                        tabindex="-1">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-image'></i></div>
                            <div class="tab-title">Room Photos</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#primarynumber" role="tab" aria-selected="false"
                        tabindex="-1">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-image'></i></div>
                            <div class="tab-title">Room Number</div>
                        </div>
                    </a>
                </li>
            </ul>
            <form method="post" action="{{ route('admin.room-update', $room) }}" enctype="multipart/form-data">
                @csrf
                <div class="tab-content py-3">
                    <div class="tab-panel fade show active" id="primaryhome" role="tabpanel">
                        <div class="display-inline">
                            <!-- Room Name -->
                            <div class="form-group">
                                <label class="book-label">Room Name</label>
                                <input type="text" id="room_name" name="room_name" class="form-control"
                                    value="{{ $room->room_name }}">
                            </div>
                            <!-- Room Price -->
                            <div class="form-group">
                                <label class="book-label">Price: <span class="currency"></span></label>
                                <input type="text" id="price" name="price" value="{{ $room->price }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="room-selection">
                            <!-- Room Type -->
                            <div>
                                <label class="book-label">Room Type: </label>
                                <select class="form-select" name="room_type_id">
                                    <option value="0">Change room type</option>
                                    @foreach ($roomTypes as $roomType)
                                        <option value="{{ $roomType->id }}"
                                            {{ $roomType->id == $room->room_type_id ? 'selected' : '' }}>
                                            {{ $roomType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="display-inline">
                            <!-- Total Adult -->
                            <div class="form-group">
                                <label class="book-label">Total Adult:</label>
                                <input type="number" id="total_adult" name="total_adult" value="{{ $room->total_adult }}"
                                    class="form-control">
                            </div>
                            <!-- Total Child -->
                            <div class="form-group">
                                <label class="book-label">Total Child:</label>
                                <input type="number" id="total_child" name="total_child" value="{{ $room->total_child }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="display-inline">
                            <!-- Bed Style -->
                            <div class="form-group">
                                <label class="book-label">Bed Style:</label>
                                <select name="bed_style" class="form-select">
                                    <option value="0">Select Bed Style</option>
                                    <option value="single" {{ $room->bed_style === 'single' ? 'selected' : '' }}>
                                        Single Bed</option>
                                    <option value="double" {{ $room->bed_style === 'double' ? 'selected' : '' }}>
                                        Double Bed</option>
                                    <option value="king" {{ $room->bed_style === 'king' ? 'selected' : '' }}>King
                                        Bed</option>
                                </select>
                            </div>
                            <!-- Extra Child Bed -->
                            <div class="form-group">
                                <label class="book-label">Extra Bed Style: <span style="font-size: 11px">(1 child = 1 extra
                                        single
                                        bed)</span></label>
                                <select name="extra_child_bed" class="form-select">
                                    <option value="0">Select Bed Style</option>
                                    <option value="1" {{ $room->extra_child_bed === '1' ? 'selected' : '' }}>1 kid
                                        bed</option>
                                    <option value="2" {{ $room->extra_child_bed === '2' ? 'selected' : '' }}>2 kid
                                        bed</option>
                                    <option value="3" {{ $room->extra_child_bed === '3' ? 'selected' : '' }}>3 kid
                                        bed</option>
                                </select>
                            </div>

                        </div>

                        <div class="display-inline">
                            <!-- Short Description -->
                            <div class="form-group">
                                <label class="book-label">Short Description:</label>
                                <textarea class="form-control" id="room_short_desc" name="room_short_desc" rows="3"
                                    placeholder="Description"> {{ $room->room_short_desc }}" </textarea>
                            </div>
                            <!-- Long Description -->
                            <div class="form-group">
                                <label class="book-label">Long Description:</label>
                                <textarea class="form-control" id="room_description" name="room_description" rows="3"
                                    placeholder="Description">{{ $room->room_description }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>

                    </div>

                    <div class="tab-panel fade" id="primaryphotos" role="tabpanel">

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
                            <input type="file" class="form-control" name="room_photo" multiple>
                        </div>

                        <div class="gallery-inputs">

                        </div>

                        <button type="button" class="btn-add-gallery --add--gallery">Add gallery photo</button>

                        <button type="submit" class="btn btn-primary">Save changes</button>

            </form>

            @if (count($room->gallery) > 0)
                <div class="photo-gallery">
                    @foreach ($room->gallery as $key => $photo)
                        <img src="{{ asset('/upload/room_photos') . '/' . $photo->room_photo }}" class="room-photo"
                            alt="room-{{ $key + 1 }}" width="200px">
                        <form action="{{ route('admin.delete-photo', $photo->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Photo</button>
                        </form>
                    @endforeach
                </div>
            @endif
        </div>


        <div class="tab-panel fade" id="primarynumber" role="tabpanel">
            <form method="post" action="{{ route('admin.room-update', $room) }}" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="room_type_id" value="{{ $room->room_type_id }}">

                <div class="display-inline">
                    <div class="form-group">
                        <label class="book-label">Room Number</label>
                        <input type="text" id="room_number" name="room_number" class="form-control"
                            value="{{ $room->room_number }}">
                    </div>
                    <div class="form-group">
                        <label class="book-label">Room Status: </label>
                        <select name="status" class="form-select">
                            <option value="0">Select room status</option>
                            <option value="active" {{ $room->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $room->status === 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>

    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
