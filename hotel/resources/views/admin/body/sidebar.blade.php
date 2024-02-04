<header>
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
                    <a href="{{ route('admin.booking-list') }}">
                        <i class='bx bx-book-content'></i>
                        <span class="nav-item">BookingList</span>
                    </a>
                    <span class="tooltip">BookingList</span>
                </li>
                <li>
                    <a href="{{ route('admin.booked-room-list') }}">
                        <i class='bx bx-list-ul'></i>
                        <span class="nav-item">RoomListStatus</span>
                    </a>
                    <span class="tooltip">RoomListStatus</span>
                </li>
                <li>
                    <a href="{{ route('admin.room-type-list') }}">
                        <i class='bx bx-sitemap'></i>
                        <span class="nav-item">RoomType</span>
                    </a>
                    <span class="tooltip">RoomType</span>
                </li>

                <li>
                    <a href="{{ route('admin.create-room') }}">
                        <i class='bx bx-plus bx-create-room'></i>
                        <i class='bx bx-hotel'></i>
                        <span class="nav-item">CreateRoom</span>
                    </a>
                    <span class="tooltip">CreateRoom</span>
                </li>


                <li>
                    <a href="{{ route('admin.request-message') }}">
                        <i class='bx bx-message'></i>
                        <span class="nav-item">RequestMessage</span>
                    </a>
                    <span class="tooltip">RequestMessage</span>
                </li>

                {{-- <li>
                    <a href="{{ route('admin.smtp-setting') }}">
                        <i class='bx bxs-cog'></i>
                        <span class="nav-item">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
                </li> --}}
                <li>
                    <a href="{{ route('admin.book-area') }}">
                        <i class='bx bxs-chalkboard'></i>
                        <span class="nav-item">BookArea</span>
                    </a>
                    <span class="tooltip">BookArea</span>
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
</header>
