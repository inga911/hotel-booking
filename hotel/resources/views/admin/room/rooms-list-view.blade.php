@extends('admin.admin-dashboard')

@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        All rooms of <i>{{ $roomType->name }}</i> type
    </h1>

    <div class="">
        <div class="card-body">
            @if ($roomList->isEmpty())
                <div class="card">
                    <div class="card-body">
                        This category does not have rooms.
                    </div>
                </div>
            @else
                @foreach ($roomList as $room)
                    <div class="card mb-3 each-room-card">
                        <div class="card-body">
                            <table class="room-details">
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Room Name:</b></th>
                                    <td class="card-right">{{ $room->room_name }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Room Type:</b></th>
                                    <td class="card-right">{{ $room->roomType->name }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Total Adult:</b></th>
                                    <td class="card-right">{{ $room->total_adult }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Total Child:</b></th>
                                    <td class="card-right">{{ $room->total_child }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Room Price:</b></th>
                                    <td class="card-right">{{ $room->price }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Bed Style:</b></th>
                                    <td class="card-right">{{ $room->bed_style }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Short Description:</b></th>
                                    <td class="card-right">{{ $room->room_short_desc }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Long Description:</b></th>
                                    <td class="card-right">{{ $room->room_description }}</td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Photo:</b></th>
                                    <td class="card-right">
                                        <img src="{{ !empty($room->photo) ? url('upload/room_photos/' . $room->photo) : url('upload/noimage.jpg') }}"
                                            class="room-photo" alt="room photo" width="200px">
                                    </td>
                                </tr>
                                <tr class="room-detail-line">
                                    <th class="card-left"><b>Photo Gallery:</b></th>
                                    <td class="card-right">
                                        @if (count($room->gallery) > 0)
                                            <div class="photo-gallery">
                                                @foreach ($room->gallery as $key => $photo)
                                                    <img src="{{ asset('/upload/room_photos') . '/' . $photo->room_photo }}"
                                                        class="room-photo" alt="room-{{ $key + 1 }}" width="200px">
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="photo-gallery no-background">
                                                <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="room-photo"
                                                    alt="room-1" width="200px">
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="room-detail-line">
                                    <a href="{{ route('admin.room-edit', $room) }}" class="add-new-room room-edit">Edit</a>
                                    <form action="{{ route('admin.room-delete', $room) }}" method="post">
                                        <button type="submit" class="btn-delete room-delete">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
