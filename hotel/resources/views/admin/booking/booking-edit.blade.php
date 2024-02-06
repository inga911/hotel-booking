@extends('admin.admin-dashboard')
@section('admin')
    @include('admin.body.errors')
    @include('admin.body.messages')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>Booking Editing
    </h1>
    <div class="main-info-top">
        <div class="horizontal-cards">
            <div class="card-top">
                <div class="card-body">
                    <strong>Booking No:</strong>
                    <div>{{ $bookingEditData->code }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Room was booked at:</strong>
                    <div>{{ $bookingEditData->created_at }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body" name="payment_status">
                    <strong>Payment method:</strong>
                    <div>{{ $bookingEditData->payment_method }}</div>
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Payment status:</strong>
                    @if ($bookingEditData->payment_status == '1')
                        <div>Complete</div>
                    @else
                        <div>Pending</div>
                    @endif
                </div>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <strong>Booking status:</strong>
                    @if ($bookingEditData->status == '1')
                        <div>Active</div>
                    @elseif ($bookingEditData->status == '2')
                        <div>Done</div>
                    @else
                        <div>Pending</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="booking-edit-container">
        {{-- BOOKED ROOM DETAILS --}}
        <div class="card booked-room-details">
            <h4 class="booking-edit-title">Booked room details</h4>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="table-top">Room Type</th>
                                <th class="table-top">Room ID / Number / Name</th>
                                <th class="table-top">Check IN</th>
                                <th class="table-top">Check Out</th>
                                <th class="table-top">Guest (adult)</th>
                                <th class="table-top">Guest (child)</th>
                                <th class="table-top">Days (total)</th>
                                <th class="table-top">Room Price</th>
                                <th class="table-top">Price (total)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $bookingEditData['room']['roomType']['name'] }}</td>
                                <td>{{ $bookingEditData['room']['id'] }} / {{ $bookingEditData['room']['room_number'] }} /
                                    {{ $bookingEditData['room']['room_name'] }}
                                </td>
                                <td>{{ $bookingEditData->check_in }}</td>
                                <td>{{ $bookingEditData->check_out }}</td>
                                <td> {{ $bookingEditData->total_adult }}</td>
                                <td>{{ $bookingEditData->total_child }}</td>
                                <td>{{ $bookingEditData->total_night }}</td>
                                <td> {{ $bookingEditData['room']['price'] }}</td>
                                <td>{{ $bookingEditData->total_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="update-data">
                    <form action="{{ route('admin.update-booking-status', $bookingEditData->id) }}" method="post">
                        @csrf
                        <div>
                            <div class="payment-booking-status">
                                <h5 class="booking-edit-title">Update status</h5>
                                <div>
                                    <label class="label">Payment Status</label>
                                    <select name="payment_status">
                                        <option selected="">Select Status..</option>
                                        <option value="0"
                                            {{ $bookingEditData->payment_status == 0 ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="1"
                                            {{ $bookingEditData->payment_status == 1 ? 'selected' : '' }}>
                                            Complete
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label class="label">Booking Status</label>
                                    <select name="status">
                                        <option selected="">Select Status..</option>
                                        <option value="0" {{ $bookingEditData->status == 0 ? 'selected' : '' }}
                                            class="input">
                                            Pending
                                        </option>
                                        <option value="1" {{ $bookingEditData->status == 1 ? 'selected' : '' }}
                                            class="input">
                                            Active
                                        </option>
                                        <option value="2" {{ $bookingEditData->status == 2 ? 'selected' : '' }}
                                            class="input">
                                            Done
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" onclick="return confirm('Are you sure?')">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- MANAGE BOOKING DATES --}}
                    <div class="manage-booking-dates">
                        <h5 class="booking-edit-title">Manage room book dates</h5>
                        <div class="card-body">
                            <form action="{{ route('admin.update-check-in-out', $bookingEditData->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="label-input">
                                        <label class="label">Check-in</label>
                                        <input type="date" required name="check_in" class="input"
                                            value="{{ $bookingEditData->check_in }}">
                                    </div>
                                    <div class="label-input">
                                        <label class="label">Check-out</label>
                                        <input type="date" required name="check_out" class="input"
                                            value="{{ $bookingEditData->check_out }}">
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Are you sure?')">Update </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- CUSTOMER INFORMATION --}}
        <div class="card customer-information">
            <h4 class="booking-edit-title">Customer information</h4>
            <div class="card-body">
                <ul class="customer-list">
                    <li><b>Name:</b>
                        <div class="user-info">{{ $bookingEditData['user']['name'] }}</div>
                    </li>
                    <li><b>Email:</b>
                        <div class="user-info">{{ $bookingEditData['user']['email'] }}</div>
                    </li>
                    <li><b>Phone:</b>
                        <div class="user-info">{{ $bookingEditData['user']['phone'] }}</div>
                    </li>
                    <li><b>Country:</b>
                        <div class="user-info">{{ $bookingEditData->country }}</div>
                    </li>
                    <li><b>State:</b>
                        <div class="user-info">{{ $bookingEditData->state }}</div>
                    </li>
                    <li><b>Post Code:</b>
                        <div class="user-info">{{ $bookingEditData->post_code }}</div>
                    </li>
                    <li><b>Address:</b>
                        <div class="user-info">{{ $bookingEditData->address }}</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
