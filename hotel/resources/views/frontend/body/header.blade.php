{{-- <header class="header"> --}}
<nav class="top-nav">
    <a href="/">
        <img class="header-logo" src="{{ asset('frontend/assets/images/logo/logo.jpg') }}" alt="Hotel logo">
    </a>
    <input class="menu-btn" type="checkbox" id="menu-btn">
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="/" class="nav-link">Home</a></li>
        <li><a href="{{ route('frontend.show.all.room') }}" class="nav-link">All rooms</a></li>
        <li><a href="{{ route('frontend.contact') }}" class="nav-link">Contact us</a></li>
        @auth
            <li>
                <a href="{{ route('user.reservations-details') }}" class="nav-link">
                    <i class='bx bxs-user-account front-header-icon'></i>My reservations
                </a>
            </li>
            <li>
                <a href="{{ route('user.logout') }}" class="nav-link">
                    <i class='bx bx-log-out front-header-icon'></i>Logout
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="nav-link">
                    <i class='bx bx-log-in front-header-icon'></i>Login
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="nav-link">
                    <i class='bx bxs-user-rectangle  front-header-icon'></i>Register
                </a>
            </li>
        @endauth
    </ul>
</nav>
{{-- </header> --}}
