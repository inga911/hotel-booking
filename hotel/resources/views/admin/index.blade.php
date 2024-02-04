@extends('admin.admin-dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>main admin content

    </h1>
    @php
        $bookings = App\Models\Booking::latest()->get();
        $pendingBooking = App\Models\Booking::where('status', '0')->get();
        $activeBooking = App\Models\Booking::where('status', '1')->get();
        $doneBooking = App\Models\Booking::where('status', '2')->get();
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
                    <strong>Active Booking:</strong>
                    <div>{{ count($activeBooking) }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body" name="payment_status">
                    <strong>Done Booking:</strong>
                    <div>{{ count($doneBooking) }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Total Price:</strong>
                    <div>{{ $totalPrice }}</div>
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
            <a href="{{ route('admin.request-message') }}">
                <div class="card-top">
                    <div class="card-body">
                        <strong> Messages:</strong>
                        <div> {{ $messagesCount }}</div>
                    </div>
                </div>
            </a>
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
                            <th>Payment Status</th>
                            <th>Booking Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingBooking as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ route('admin.booking-edit', $item->id) }}">{{ $item->code }}</a></td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>{{ $item['user']['name'] }}</td>
                                <td>{{ $item['room']['roomType']['name'] }}</td>
                                <td>{{ $item->check_in }} / {{ $item->check_out }}</td>
                                <td>{{ $item->totalGuests }} (Adult: {{ $item->total_adult }} and child:
                                    {{ $item->total_child }})</td>
                                <td>
                                    @if ($item->payment_status == 1)
                                        <div>Complete</div>
                                    @else
                                        <div>Pending</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <div>Active</div>
                                    @elseif ($item->status == 2)
                                        <div>Done</div>
                                    @else
                                        <div>Pending</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No new bookings today</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>


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
@endsection
