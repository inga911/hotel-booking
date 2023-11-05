@extends('admin.admin-dashboard')

@section('admin')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Room types
    </h1>
    <div class="roon-type-container">
        <div class="card">
            @if ($roomType->isEmpty())
                <p>No rooms yet.</p>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room Name</th>
                            <th scope="col" colspan="3">Links</th>
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
                                    <form action="{{ route('admin.room-type-delete', ['roomType' => $type->id]) }}"
                                        method="post">
                                        <button type="submit" class="btn-delete">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.room-type.rooms', ['roomType' => $type->id]) }}">View rooms of
                                        this type</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <a href="{{ route('admin.add-room-type') }}" class="add-new-room">Add Room Type</a>
        </div>
    </div>
@endsection
