@extends('admin.admin-dashboard')
@section('admin')
    <div class="profile-container">
        <h3 class="admin-title">
            <i class='bx bxs-chevron-right'></i>
            Admin Profile
        </h3>
        <div class="admin-profile-card">
            <div>
                @if ($admin->user_photo)
                    <img src="{{ asset('/backend/assets/image') . '/' . $admin->user_photo }}" class="admin-profile-photo"
                        alt="product photo">
                @else
                    <img src="{{ asset('/backend/assets/image') . '/user.jpg' }}" class="admin-profile-photo">
                @endif
            </div>
            <div class="admin-info">
                <div>
                    <label>Name: </label>
                    <label>{{ $admin->name }}</label>
                </div>
                <div>
                    <label>Status: </label>
                    <label>{{ $admin->status }}</label>
                </div>
                <div>
                    <label>Role: </label>
                    <label>{{ $admin->role }}</label>
                </div>

            </div>
        </div>
    </div>
@endsection
