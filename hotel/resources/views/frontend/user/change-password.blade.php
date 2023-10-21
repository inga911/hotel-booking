@extends('frontend.main-content')
@section('content')
    <div class="user-profile-container user-container">
        @include('frontend.user.user-sidebar')

        <div class="card">
            <h2 class="contact-title">Change Password</h2>
            <div class="form">
                <form action="{{ route('user.change-password-store') }}" method="post">
                    @csrf
                    <div class="label">
                        <label>Old Password</label>
                        <input type="password" name="old_password" @error('old_password') is-invalid @enderror
                            id="old_password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="label">
                        <label>New Password</label>
                        <input type="password" name="new_password" @error('new_password') is-invalid @enderror
                            id="new_password">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="label">
                        <label>Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-danger">Edit & Save password</button>

                </form>
            </div>
        </div>



    </div>
@endsection
