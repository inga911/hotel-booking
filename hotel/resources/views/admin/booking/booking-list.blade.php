@extends('admin.admin-dashboard')
@section('admin')
    <h1>Booking List</h1>
    <div class="page-content">

        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="example" class="table table-striped table-bordered" style="width:100%">

                        <thead>

                            <tr>

                                <th>Sl</th>

                                <th>Booking No</th>

                                <th>Booking Date</th>

                                <th>Customer ID</th>

                                <th>Room ID</th>

                                <th>Check IN/Out</th>

                                <th>Guest (total)</th>

                                <th>Payment status</th>

                                <th>Status</th>

                                <th>Action buttons</th>

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
                                        (Adult: {{ $item->total_adult }} and child: {{ $item->total_child }})
                                    </td>

                                    <td>
                                        @if ($item->payment_method == '1')
                                            <div>Complete</div>
                                        @else
                                            <div>Pending</div>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->status == '1')
                                            <div>Active</div>
                                        @else
                                            <div>Pending</div>
                                        @endif
                                    </td>

                                    <td>


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
