@extends('admin.admin-dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>main admin content

    </h1>
    {{-- DROPDOWN NOTIFICATIONS --}}
    {{-- <li class="nav-item dropdown dropdown-large" style="list-style: none">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown">
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
    @php
        $bookings = App\Models\Booking::latest()->get();
        $pendingBooking = App\Models\Booking::where('status', '0')->get();
        $completeBooking = App\Models\Booking::where('status', '1')->get();
        $totalPrice = App\Models\Booking::sum('total_price');

        $today = Carbon\Carbon::now()->toDateString();
        $todayTotalPrice = App\Models\Booking::whereDate('created_at', $today)->sum('total_price');

        $todayTotalBookings = App\Models\Booking::whereDate('created_at', $today)->count();

        $allData = App\Models\Booking::orderBy('id', 'desc')
            ->limit(10)
            ->get();

    @endphp
    <div class="main-info-top">
        <div class="horizontal-cards">
            <div class="card-top">
                <div class="card-body">
                    <strong>Total Bookings:</strong>
                    <div>{{ count($bookings) }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Pending Booking:</strong>
                    <div>{{ count($pendingBooking) }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body" name="payment_status">
                    <strong>Complete Booking:</strong>
                    <div>{{ count($completeBooking) }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Total Price:</strong>
                    <div>{{ $totalPrice }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Today total Price:</strong>
                    <div>{{ $todayTotalPrice }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-info-top">
        <div class="horizontal-cards">
            <div class="card-top">
                <div class="card-body">
                    <strong>{{ $today }} bookings:</strong>
                    <div>{{ $todayTotalBookings }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>{{ $today }} total price:</strong>
                    <div>{{ $todayTotalPrice }}</div>
                </div>
            </div>
        </div>
    </div>



    <div>
        <div>
            <div>
                <div>
                    <div>
                        <div>
                            <h3>Sales Overview</h3>
                        </div>
                    </div>
                </div>
                <div>
                    <canvas id="bookingChart" style="position: relative; height:40vh; width:80vw">

                    </canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>Recent Booking</h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Booking No</th>
                            <th>Booking Date</th>
                            <th>Customer ID</th>
                            <th>Room</th>
                            <th>Check IN/Out</th>
                            <th>Guest (total)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <a href="{{ route('admin.booking-edit', $item->id) }}">
                                        {{ $item->code }}
                                    </a>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y') }} </td>
                                <td>{{ $item['user']['name'] }} </td>
                                <td>{{ $item['room']['roomType']['name'] }} </td>
                                <td>{{ $item->check_in }} / {{ $item->check_out }} </td>
                                <td>
                                    {{ $item->totalGuests }}
                                    (Adult: {{ $item->total_adult }} and child: {{ $item->total_child }})
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- <li class="nav-item dropdown dropdown-large" style="list-style: none">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"
            style="color: #fff">
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

    <script>
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
    </script>

    <script>
        var ctx = document.getElementById('bookingChart').getContext('2d');

        var labels = [];
        var bookingsData = [];

        @for ($i = 9; $i >= 0; $i--)
            @php
                $date = now()
                    ->subDays($i)
                    ->toDateString();
                $todayTotalBookings = App\Models\Booking::whereDate('created_at', $date)->count();
            @endphp

            labels.push('{{ $date }}');
            bookingsData.push({{ $todayTotalBookings }});
        @endfor

        var bookingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Bookings Per Day',
                    data: bookingsData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, ]
            },
            options: {

                animation: {
                    duration: 1000,
                    easing: 'easeInOutCubic',
                },
                scales: {
                    x: {
                        border: {
                            color: 'red'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        },
                    },
                    y: {
                        // suggestedMin: 5,
                        // suggestedMax: 30,
                        beginAtZero: true,
                        stepSize: 1,
                        title: {
                            display: true,
                            text: 'Value'
                        },
                    }
                }
            }

        });
    </script>
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
@endsection
