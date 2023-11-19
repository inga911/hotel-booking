<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>


</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td>
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="font-size: 26px;"><strong>HotelBooking</strong></h2>
            </td>
            <td>
                <pre>
               HotelBooking Head Office
               Email:hotel@booking.com <br>
               Mob: 1245454545 <br>
               Company address <br>
              
            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;">
        <thead>
            <tr>
                <th>Room Type</th>
                <th>Room Number</th>
                <th>Check IN</th>
                <th>Check Out</th>
                <th>Guest (adult)</th>
                <th>Guest (child)</th>
                <th>Days (total)</th>
                <th>Room Price</th>
                <th>Price (total)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $allUserBookingData['room']['roomType']['name'] }}</td>
                <td>{{ $allUserBookingData['room']['room_number'] }}
                </td>
                <td>{{ $allUserBookingData->check_in }}</td>
                <td>{{ $allUserBookingData->check_out }}</td>
                <td> {{ $allUserBookingData->total_adult }}</td>
                <td>{{ $allUserBookingData->total_child }}</td>
                <td>{{ $allUserBookingData->total_night }}</td>
                <td> {{ $allUserBookingData['room']['price'] }}</td>
                <td>{{ $allUserBookingData->total_price }}</td>
            </tr>
        </tbody>

    </table>
    <br />





    <table style="float:right; border:none">

    </table>


    <div>
        <p>Thanks For Your Booking..!!</p>
    </div>
    <div>
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div>
</body>

</html>
