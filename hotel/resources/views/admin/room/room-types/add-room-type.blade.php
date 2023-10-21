@extends('admin.admin-dashboard')
@section('admin')
    <h1>here will be ADD ROOM TYPE page</h1>
    <div class="card">
        <h2 class="contact-title">Room Type</h2>
        <div class="form">
            <form action="{{ route('admin.room-type-store') }}" method="post">
                @csrf
                <div class="label">
                    <label>Name</label>
                    <input type="text" name="name" />
                </div>

                <button type="submit" class="btn btn-danger">Add room type</button>

            </form>
        </div>
    </div>
@endsection
