@extends('frontend.main-content')
@section('content')
    <div class="user-reservation-container">
        @include('frontend.user.user-sidebar')
        <div class="user-reservation-container__card profile-card reservations-card ">
            <h1 class="user-profile-title">
                <i class='bx bxs-chevron-right'></i>Your reservations
            </h1>
            @forelse ($allUserBookingData as $item)
                <table class="table user-table">
                    <tr>
                        <th>Booking Number</th>
                        <td>
                            {{ $item->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>Booking Date</th>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Customer</th>
                        <td>{{ $item['user']['name'] }}</td>
                    </tr>
                    <tr>
                        <th>Room</th>
                        <td>{{ $item['room']['room_name'] }}</td>
                    </tr>
                    <tr>
                        <th>Check IN/OUT</th>
                        <td>{{ $item->check_in }} / {{ $item->check_out }}</td>
                    </tr>
                    <tr>
                        <th>Guest</th>
                        <td>
                            <i class='bx bx-male-female'></i>
                            {{ $item->total_adult }}
                            /
                            <i class='bx bx-child'></i>
                            {{ $item->total_child }}
                        </td>
                    </tr>
                    <tr>
                        <th>Total price</th>
                        <td>
                            {{ $item->total_price }} <i class='bx bx-euro'></i>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($item->status == '1' || $item->status == '2')
                                <a href="{{ route('user.invoice', $item->id) }}" class="user-download">
                                    <i class='bx bxs-download'></i>
                                    Complete
                                </a>
                            @else
                                <i class='bx bx-loader-circle bx-spin'></i> Awaiting confirmation
                            @endif
                        </td>
                    </tr>
                </table>
            @empty
                <div>
                    You don't have any reservations yet. You can book your room <a href="/"
                        class="start-room-search">HERE.</a>
                </div>
            @endforelse
            <div class="pagination-div">{{ $allUserBookingData->links() }}</div>
        </div>
    </div>
@endsection
