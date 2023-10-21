<div class="sidebar" id="btn">
    <div class="top">
        <div class="logo">
            <i class='bx bxs-dashboard bx-flip-horizontal'></i>
            <span>Admin dashboard</span>
        </div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <div class="user">
        <img src="{{ asset('backend/assets/image/user.jpg') }}" alt="user image" class="user-img">
        <div>
            <p class="admin-name">Name Surname</p>
            <p>Admin</p>
        </div>
    </div>
    <ul>
        <li>
            <a href="{{ route('admin.profile') }}">
                <i class='bx bx-id-card'></i>
                <span class="nav-item">Profile</span>
            </a>
            <span class="tooltip">Profile</span>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="bx bx-home"></i>
                <span class="nav-item">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="{{ route('admin.book-area') }}">
                <i class='bx bx-book-open'></i>
                <span class="nav-item">BookArea</span>
            </a>
            <span class="tooltip">Book Area</span>
        </li>
        <li>
            <a href="{{ route('admin.room-list') }}">
                <i class='bx bx-hotel'></i>
                <span class="nav-item">ManageRoom</span>
            </a>
            <span class="tooltip">ManageRoom</span>
        </li>
        {{-- <li>
            <a href="#">
                <i class="bx bx-body"></i>
                <span class="nav-item">Customers</span>
            </a>
            <span class="tooltip">Customers</span>
        </li> --}}
        <li>
            <a href="#">
                <i class="bx bx-cog"></i>
                <span class="nav-item">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
            <span class="tooltip">Logout</span>
        </li>
    </ul>
</div>
