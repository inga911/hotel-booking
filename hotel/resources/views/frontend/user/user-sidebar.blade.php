<div class="user-navbar">
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="">User dashboard</a>
        </li>
        {{-- <li>
            <a href="{{ route('user.profile') }}" class="">Profile</a>
        </li> --}}
        <li>
            <a href="{{ route('user.edit-profile') }}" class="">Profile</a>
        </li>
        <li>
            <a href="#" class="">My reservations</a>
        </li>
        <li>
            <a href="{{ route('user.change-password') }}" class="">Change password</a>
        </li>
    </ul>
</div>
