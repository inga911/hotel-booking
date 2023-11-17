<div class="sidebar" id="btn">
    <div class="sidebar-sticky">
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
                <a href="{{ route('admin.profile') }}">
                    <p class="admin-name">{{ $admin->name }}</p>
                    <p class="profile-status">{{ $admin->role }} <span
                            class="profile-status">{{ $admin->status }}</span>
                    </p>
                </a>
            </div>
        </div>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-home-alt-2'></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="{{ route('admin.book-area') }}">
                    <i class='bx bx-book-open'></i>
                    <span class="nav-item">BookArea</span>
                </a>
                <span class="tooltip">BookArea</span>
            </li>
            <li>
                <a href="{{ route('admin.room-list') }}">
                    <i class='bx bx-sitemap'></i>
                    <span class="nav-item">ManageRoom</span>
                </a>
                <span class="tooltip">ManageRoom</span>
            </li>
            <li>
                <a href="{{ route('admin.create-room') }}">
                    <i class='bx bx-hotel'></i>
                    <span class="nav-item">CreateRoom</span>
                </a>
                <span class="tooltip">CreateRoom</span>
            </li>
            <li>
                <a href="{{ route('admin.booking-list') }}">
                    <i class='bx bx-hotel'></i>
                    <span class="nav-item">BookingList</span>
                </a>
                <span class="tooltip">BookingList</span>
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
</div>
