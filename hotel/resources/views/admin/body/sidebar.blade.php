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
                <p class="admin-name">{{ $admin->name }}</p>
                <p class="profile-status">{{ $admin->role }} <span class="profile-status">{{ $admin->status }}</span>
                </p>
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
                <a href="{{ route('admin.logout') }}">
                    <i class="bx bx-log-out"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>
</div>
