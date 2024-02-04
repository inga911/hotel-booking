@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        All Booking List
    </h1>
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Booking No</th>
                                <th>Reservation made at</th>
                                <th>Client Name</th>
                                <th>Room Type</th>
                                <th>Check IN/Out</th>
                                <th>Guest (total)</th>
                                <th>Payment status</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allBookingData as $key => $item)
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
                                        (Adult: {{ $item->total_adult }} / child: {{ $item->total_child }})
                                    </td>
                                    <td>
                                        @if ($item->payment_status == '1')
                                            <div>Complete</div>
                                        @else
                                            <div>Pending</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == '1')
                                            <div>Active</div>
                                        @elseif ($item->status == '2')
                                            <div>Done</div>
                                        @else
                                            <div>Pending</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
