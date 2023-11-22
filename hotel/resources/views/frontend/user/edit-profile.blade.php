@extends('frontend.main-content')
@section('content')
    <div class=" user-container">
        @include('frontend.user.user-sidebar')
        <div class="profile-card ">
            <h1 class="user-main-title">
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
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $user->address }}" />
                    </div>
                    <div class="">
                        <div class="user-form-label">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" />
                        </div>
                    </div>
                    <div class="">
                        <div class="user-form-label">
                            <label>Phone number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="checkin-button user-btn">Edit & Save profile information</button>

                </form>
            </div>
        </div>



    </div>
@endsection
