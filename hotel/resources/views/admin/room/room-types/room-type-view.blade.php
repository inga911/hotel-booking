@extends('admin.admin-dashboard')

@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Room types
    </h1>
    @include('admin.body.errors')
    @include('admin.body.messages')
    <div class="roon-type-container">
        <div class="card">
            @if ($roomCounts->isEmpty())
                <p>No room types yet.</p>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room Name</th>
                            <th scope="col" colspan="4">Links</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roomCounts as $key => $type)
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
                                <td>
                                    <div>{{ $type->rooms_count }}</div>
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
