<nav class="nav">
    <a href="/">
        <img class="nav__logo" src="{{ asset('frontend/assets/images/logo/logo.jpg') }}" alt="Hotel logo">
    </a>
    <input class="nav__btn" type="checkbox" id="menu-btn">
    <label class="nav__icon" for="menu-btn"><span class="hamburger"></span></label>
    <div class="nav__menu">
        <a href="/" class="nav__menu--link">Home</a></li>
        <a href="{{ route('frontend.show.all.room') }}" class="nav__menu--link">All rooms</a></li>
        <a href="{{ route('frontend.contact') }}" class="nav__menu--link">Contact us</a></li>
        @auth
            <a href="{{ route('user.reservations-details') }}" class="nav__menu--link">
                <i class='bx bxs-user-account'></i>My reservations
            </a>
            <a href="{{ route('user.logout') }}" class="nav__menu--link">
                <i class='bx bx-log-out'></i>Logout
            </a>
        @else
            <a href="{{ route('login') }}" class="nav__menu--link">
                <i class='bx bx-log-in'></i>Login
            </a>
            <a href="{{ route('register') }}" class="nav__menu--link">
                <i class='bx bxs-user-rectangle '></i>Register
            </a>
        @endauth
    </div>
</nav>
