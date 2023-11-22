@extends('frontend.main-content')
@section('content')
    <div class="user-container">
        @include('frontend.user.user-sidebar')
        <div class="profile-card reservations-card">
            <h1 class="user-main-title">
                <i class='bx bxs-chevron-right'></i>Your reservations
            </h1>
            <div>
                @foreach ($allUserBookingData as $item)
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
                            <td>{{ $item['room']['roomType']['name'] }}</td>
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
                            <th>Status</th>
                            <td>
                                @if ($item->status == '1')
                                    <a href="{{ route('user.invoice', $item->id) }}" class="user-download">
                                        <i class='bx bxs-download'></i>
                                        Complete
                                    </a>
                                @else
                                    Pending
                                @endif
                            </td>
                        </tr>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection
