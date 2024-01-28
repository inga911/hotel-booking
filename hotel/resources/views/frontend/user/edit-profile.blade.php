@extends('frontend.main-content')
@section('content')
    <div class="user-profile-container">
        @include('frontend.user.user-sidebar')
        <div class="user-profile-container__card">
            <h1 class="user-profile-title">
                <i class='bx bxs-chevron-right'></i>My Profile
            </h1>
            @if (session('message'))
                <div class="alert alert-{{ session('alert-type') }}"
                    style="color: rgb(0, 144, 36); text-transform:uppercase; padding:1em">
                    {{ session('message') }}
                </div>
            @endif
            <div class="form">
                <form action="{{ route('profile.store') }}" method="post">
                    @csrf
                    <div class="user-form-label">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="user-form-label">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" />
                    </div>
                    <div class="user-form-label">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $user->address }}" />
                    </div>
                    <div class="user-form-label">
                        <label>City</label>
                        <input type="text" name="town" value="{{ $user->town }}" />
                    </div>
                    <div class="user-form-label">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="user-form-label">
                        <label>Phone number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" />
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="user-profile-btn">Edit & Save profile information</button>
                </form>
            </div>
        </div>
    </div>
@endsection
