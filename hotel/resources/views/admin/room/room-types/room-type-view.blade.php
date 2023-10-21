@extends('admin.admin-dashboard')
@section('admin')
    <h1>here will be room types</h1>
    <a href="{{ route('admin.add-room-type') }}">Add Room Type</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Room Name</th>
                <th scope="col">Main Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roomType as $key => $type)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $type->name }}</td>
                    <td>desplayed image</td>
                    <td><a href=""> Edit</a>
                        <a href=""> Delete</a>
                    </td>
            @endforeach
        </tbody>
    </table>
@endsection
