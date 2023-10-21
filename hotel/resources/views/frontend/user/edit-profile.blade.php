@extends('frontend.main-content')
@section('content')
    <div class="user-profile-container user-container">
        @include('frontend.user.user-sidebar')

        <div class="card">
            <h2 class="contact-title">User Profile</h2>
            <div class="form">
                <form action="{{ route('profile.store') }}" method="post">
                    @csrf
                    <div class="label">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="label">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $user->address }}" />
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" />
                        </div>
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Phone nummber</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Edit & Save profile information</button>

                </form>
            </div>
        </div>



    </div>
@endsection
