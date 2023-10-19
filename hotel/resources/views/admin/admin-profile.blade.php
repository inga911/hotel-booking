@extends('admin.admin-dashboard')
@section('admin')
    <div class="profile-container">
        <h3>Admin Profile</h3>
        <div class="row">
            <div class="admin-photo">
                @if ($admin->user_photo)
                    <img src="{{ asset('/backend/assets/image') . '/' . $admin->user_photo }}" class="photo"
                        alt="product photo">
                @else
                    <img src="{{ asset('/backend/assets/image') . '/user.jpg' }}" class="photo">
                @endif
            </div>
            <div class="admin-info">
                <div>
                    <p>Name: {{ $admin->name }}</p>
                </div>
                <div>
                    <p>Status: {{ $admin->status }}</p>
                </div>
                <div>
                    <p>Addres: {{ $admin->adress }}</p>
                </div>
                <div>
                    <p>Role: {{ $admin->role }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
