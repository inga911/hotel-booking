<header>
    <nav class="top-nav">

        <a href="/">
            <img src="{{ asset('frontend/assets/images/logo/logo.jpg') }}" class="header-logo" alt="Hotel logo">
        </a>

        <div class="top-right">
            <a href="#" class="nav-link">Language</a>
            <a href="#" class="nav-link">Valiuta</a>
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class='bx bxs-user-account front-header-icon'></i>My account
                </a>
                <a href="{{ route('user.logout') }}" class="nav-link">
                    <i class='bx bx-log-out front-header-icon'></i>Logout
                </a>
            @else
                <a href="{{ route('login') }}" class="nav-link">
                    <i class='bx bx-log-in front-header-icon'></i>Login
                </a>
                <a href="{{ route('register') }}" class="nav-link">
                    <i class='bx bxs-user-rectangle  front-header-icon'></i>Register
                </a>
            @endauth
        </div>
    </nav>
</header>
