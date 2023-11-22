<header>
    <div class="sidebar" id="btn">
        <div class="sidebar-sticky">
            <div class="top">
                <div class="logo">
                    <i class='bx bxs-dashboard bx-flip-horizontal'></i>
                    <span>Admin dashboard</span>
                </div>
                <i class="bx bx-menu" id="btn"></i>

                {{--  --}}
                {{-- <li class="nav-item dropdown dropdown-large" style="list-style: none">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                        data-bs-toggle="dropdown" style="color: #fff">
                        @php
                            $ncount = Auth::user()
                                ->unreadNotifications()
                                ->count();
                        @endphp
                        <span class="alert-count" id="notification-count"
                            style="    color: red;
                    position: absolute;
                    left: 35px;
                    top: 50px;">{{ $ncount }}</span>
                        <i class='bx bx-bell'></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="javascript:;">
                            <div class="msg-header">
                                <p class="msg-header-title">Notifications</p>
                                <p class="msg-header-badge"> </p>
                            </div>
                        </a>
                        <div class="header-notifications-list">

                            @php
                                $user = Auth::user();
                            @endphp

                            @forelse ($user->notifications as $notification)
                                <a class="dropdown-item" href="javascript:;"
                                    onclick="markNotificationAsRead('{{ $notification->id }}')">
                                    <div>
                                        <div><i class='bx bx-check-square'></i>
                                        </div>
                                        <div>
                                            <h6>{{ $notification->data['message'] }}<span>
                                                    {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                                </span></h6>
                                            <p>New Booking </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                            @endforelse


                        </div>
                        <a href="javascript:;">
                            <div class="text-center msg-footer">

                                <button class="btn btn-primary w-100">View All Notifications</button>
                            </div>
                        </a>
                    </div>
                </li> --}}

                {{--  --}}
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
                        <i class='bx bxs-chalkboard'></i>
                        <span class="nav-item">BookArea</span>
                    </a>
                    <span class="tooltip">BookArea</span>
                </li>
                <li>
                    <a href="{{ route('admin.room-type-list') }}">
                        <i class='bx bx-sitemap'></i>
                        <span class="nav-item">RoomType</span>
                    </a>
                    <span class="tooltip">RoomType</span>
                </li>
                <li>
                    <a href="{{ route('admin.booked-room-list') }}">
                        <i class='bx bx-list-ul'></i>
                        <span class="nav-item">RoomListStatus</span>
                    </a>
                    <span class="tooltip">RoomListStatus</span>
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
                    <a href="{{ route('admin.booking-list') }}">
                        <i class='bx bx-book-content'></i>
                        <span class="nav-item">BookingList</span>
                    </a>
                    <span class="tooltip">BookingList</span>
                </li>

                <li>
                    <a href="{{ route('admin.request-message') }}">
                        <i class='bx bx-message'></i>
                        <span class="nav-item">RequestMessage</span>
                    </a>
                    <span class="tooltip">RequestMessage</span>
                </li>

                <li>
                    <a href="{{ route('admin.smtp-setting') }}">
                        <i class='bx bxs-cog'></i>
                        <span class="nav-item">Setting</span>
                    </a>
                    <span class="tooltip">Setting</span>
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
{{-- <script>
    function markNotificationAsRead(notificationId) {
        fetch('/mark-notification-as-read/' + notificationId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('notification-count').textContent = data.count;
            })
            .catch(error => {
                console.log('Error', error);
            });
    }
</script> --}}
