@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        EDIT room type <i>{{ $roomType->name }}</i>
    </h1>

    <div class="card">
        <div class="form">
            <form method="post" action="{{ route('admin.room-type-update', ['roomType' => $roomType->id]) }}">
                @csrf
                @method('POST')
                <div class="label">
                    <label for="name">Change name:</label>
                    <input type="text" name="name" value="{{ $roomType->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Room Type</button>
            </form>
        </div>
    </div>
@endsection
