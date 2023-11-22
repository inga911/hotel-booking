@extends('frontend.main-content')
@section('content')
    <div class="user-container">
        @include('frontend.user.user-sidebar')

        <div class="profile-card">
            <h1 class="user-main-title">
                <i class='bx bxs-chevron-right'></i>
                Change Password
            </h1>
            @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}"
                    style="color: blue; text-transform:uppercase; padding:1em">
                    {{ session('message') }}
                </div>
            @endif
            <div class="form">
                <form action="{{ route('user.change-password-store') }}" method="post">
                    @csrf
                    <div class="user-form-label">
                        <label>Old Password</label>
                        <input type="password" name="old_password" @error('old_password') is-invalid @enderror
                            id="old_password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="user-form-label">
                        <label>New Password</label>
                        <input type="password" name="new_password" @error('new_password') is-invalid @enderror
                            id="new_password">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="user-form-label">
                        <label>Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                    </div>

                    <button type="submit" class="checkin-button user-btn">Edit & Save password</button>

                </form>
            </div>
        </div>



    </div>
@endsection
