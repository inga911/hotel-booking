@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Add Room Type
    </h1>
    <div class="card">
        <div class="form">
            <form action="{{ route('admin.room-type-store') }}" method="post">
                @csrf
                <div class="label">
                    <label>Enter the name of the new room:</label>
                    <input type="text" name="name" />
                </div>

                <button type="submit" class="btn btn-danger">Add room type</button>

            </form>
        </div>
    </div>
@endsection
