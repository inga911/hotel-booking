@extends('admin.admin-dashboard')

@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Room list with current status
    </h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room Type</th>
                            <th>Room Number</th>
                            <th>Booking Status</th>
                            <th>Check In/Out Date</th>
                            <th>Booking No</th>
                            <th>Customer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($room_number_list as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->roomType->name }}</td>
                                <td><a href="{{ route('admin.room-edit', $item) }}">{{ $item->room_number }}</a>
                                </td>
                                <td>
                                    @php
                                        $isCurrentlyBooked = $item->lastBooking && now()->between($item->lastBooking->check_in, $item->lastBooking->check_out);
                                    @endphp

                                    @if ($isCurrentlyBooked)
                                        @if ($item->lastBooking->payment_status == 1)
                                            <span class="badge bg-danger">Booked</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    @else
                                        <span class="badge bg-success">Available</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->lastBooking && now()->between($item->lastBooking->check_in, $item->lastBooking->check_out))
                                        {{ date('d-m-Y', strtotime($item->lastBooking->check_in)) }}
                                        to
                                        {{ date('d-m-Y', strtotime($item->lastBooking->check_out)) }}
                                    @else
                                        <span class="badge bg-success"></span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->lastBooking && now()->between($item->lastBooking->check_in, $item->lastBooking->check_out))
                                        {{ $item->lastBooking->code }}
                                    @else
                                        <div></div>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->lastBooking && now()->between($item->lastBooking->check_in, $item->lastBooking->check_out))
                                        {{ $item->lastBooking->name }}
                                    @else
                                        <div></div>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status == 'active')
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-danger">In-active</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-div">{{ $room_number_list->links() }}</div>

    </div>
@endsection
