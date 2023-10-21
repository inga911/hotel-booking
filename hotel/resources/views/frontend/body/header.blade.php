<header>
    <nav class="top-nav">

        <a href="/">
            <img src="{{ asset('frontend/assets/images/hero-section/logo.jpeg') }}" class="header-logo" alt="Hotel logo">
        </a>

        <div class="top-right">
            <a href="#">Language</a>
            <a href="#">Valiuta</a>
            @auth
                <a href="{{ route('dashboard') }}">
                    <i class='bx bxs-user-pin'></i>My account
                </a>
                <a href="{{ route('user.logout') }}">
                    <i class='bx bxs-user-rectangle'></i>Logout
                </a>
            @else
                <a href="{{ route('login') }}">
                    <i class='bx bxs-user-pin'></i>Login
                </a>
                <a href="{{ route('register') }}">
                    <i class='bx bxs-user-rectangle'></i>Register
                </a>
            @endauth
        </div>
    </nav>
    <nav class="lower-nav">
        <div class="lower-left">
            <a href="#">Hotels</a>
            <a href="#">Deals</a>
            <a href="#">Resorts</a>
        </div>
    </nav>
</header>
