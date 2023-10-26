@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Room types
    </h1>
    <div class="roon-type-container">
        <div class="card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Room Name</th>
                        <th scope="col">Links</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roomType as $key => $type)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $type->name }}</td>
                            <td>
                                <a href="{{ route('admin.room-type-edit', ['roomType' => $type->id]) }}">Edit</a>
                            </td>
                            <td>
                                {{-- <a href=""> Delete</a> --}}
                                <a href="{{ route('admin.room-type.rooms', ['roomType' => $type->id]) }}">View rooms of this
                                    type</a>

                            </td>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('admin.add-room-type') }}" class="add-new-room">Add Room Type</a>
        </div>
    </div>
@endsection
