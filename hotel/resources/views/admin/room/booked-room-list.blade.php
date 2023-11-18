@extends('admin.admin-dashboard')

@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Room list
    </h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Room Type</th>
                            <th>Room Number</th>
                            <th>Booking Status</th>
                            <th>In/Out Date</th>
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
                                <td>{{ $item->room_number }}</td>
                                <td>
                                    @if ($item->lastBooking)
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
                                    @if ($item->lastBooking)
                                        {{ date('d-m-Y', strtotime($item->lastBooking->check_in)) }}
                                        to
                                        {{ date('d-m-Y', strtotime($item->lastBooking->check_out)) }}
                                    @else
                                        ---
                                    @endif
                                </td>

                                <td>
                                    @if ($item->lastBooking)
                                        {{ $item->lastBooking->code }}
                                    @else
                                        ---
                                    @endif
                                </td>

                                <td>
                                    @if ($item->lastBooking)
                                        {{ $item->lastBooking->name }}
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
    </div>
@endsection
