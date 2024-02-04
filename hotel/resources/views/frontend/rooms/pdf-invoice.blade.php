<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>


</head>

<body>
    <div style="text-align:right; text-transform:uppercase; margin-bottom: 5%">
        <h1 style="font-size: 35px; font-weight: 100; margin-bottom:0; letter-spacing: 2px;">Hotel booking</h1>
        <p style="font-size: 15px; font-weight: 100; margin-top: 0; letter-spacing: 2px;">Confirmation</p>
    </div>

    <div style="display:inline-block; position: relative; width:100%; font-size:12px;">
        <div style="width:40%; line-height:2">
            <div
                style="text-transform:uppercase; color: rgb(120, 120, 120); font-size:12px; letter-spacing:1px; padding:10px 0">
                Hotel
                Info details</div>
            <div style="text-transform: uppercase; letter-spacing:1px;">HotelBooking</div>
            <div><span style="text-transform: uppercase; letter-spacing:1px;">Email: </span>hotel@booking-example.com
            </div>
            <div><span style="text-transform: uppercase; letter-spacing:1px;">Phone number: </span>+27113456789</div>
            <div><span style="text-transform: uppercase; letter-spacing:1px;">Address: </span>10 Forest Street Campbell,
                CA 95008</div>
        </div>
        <div style="width:50%; line-height:2; position:absolute; top:0; right:0;">
            <div
                style="text-transform:uppercase; color: rgb(120, 120, 120); font-size:12px; letter-spacing:1px; padding:10px 0">
                Client
                Info details</div>
            <div><span style="text-transform: uppercase; letter-spacing:1px;">Name: </span>
                {{ $allUserBookingData->name }} {{ $allUserBookingData->last_name }}</div>
            <div><span style="text-transform: uppercase; letter-spacing:1px;">Email: </span>
                {{ $allUserBookingData->email }}</div>
            <div><span style="text-transform: uppercase; letter-spacing:1px;">Phone number: </span>
                {{ $allUserBookingData->phone }}</div>
            @if (!empty($allUserBookingData->company_name))
                <div><span style="text-transform: uppercase; letter-spacing:1px;">Company name: </span>
                    {{ $allUserBookingData->company_name }}</div>
            @endif
        </div>
    </div>

    <div style="margin-top:5%; border-top:0.5px solid black;width:100%;padding:10px"></div>


    <div style="margin-top:2%;">
        <div
            style="text-transform:uppercase; color: rgb(120, 120, 120); font-size:12px; letter-spacing:1px; padding:10px 0">
            Booking
            info
            details</div>
        <table width="100%" style="padding: 0 5px; font-size:12px">
            <tr style="line-height: 1.5; letter-spacing:1px; ">
                <th
                    style="text-transform: uppercase; font-weight:lighter; text-align: left;background-color: rgba(249, 249, 249, 0.856)">
                    Booking number</th>
                <td style="text-align: right; margin-left:-10px;background-color: rgba(249, 249, 249, 0.856)">
                    Room ID: {{ $allUserBookingData->code }}</td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px; border-bottom:1px solid black">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Room Type</th>
                <td style="text-align: right;">{{ $allUserBookingData['room']['roomType']['name'] }}</td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px; background-color: rgba(249, 249, 249, 0.856)">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Room Number</th>
                <td style="text-align: right;">{{ $allUserBookingData['room']['room_number'] }}
                </td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px;">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Check IN</th>
                <td style="text-align: right;">{{ $allUserBookingData->check_in }} 12:00</td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px; background-color: rgba(249, 249, 249, 0.856)">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Check Out</th>
                <td style="text-align: right;">{{ $allUserBookingData->check_out }} 12:00</td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px;">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Guest (adult)</th>
                @if ($allUserBookingData->total_adult > 1)
                    <td style="text-align: right;"> {{ $allUserBookingData->total_adult }} adults</td>
                @else
                    <td style="text-align: right;"> {{ $allUserBookingData->total_adult }} adult</td>
                @endif
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px; background-color: rgba(249, 249, 249, 0.856)">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Guest (child)</th>
                @if ($allUserBookingData->total_child > 1)
                    <td style="text-align: right;"> {{ $allUserBookingData->total_child }} childs</td>
                @else
                    <td style="text-align: right;"> {{ $allUserBookingData->total_child }} child</td>
                @endif
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px;">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Nights (total)</th>
                @if ($allUserBookingData->total_night > 1)
                    <td style="text-align: right;"> {{ $allUserBookingData->total_night }} nights</td>
                @else
                    <td style="text-align: right;"> {{ $allUserBookingData->total_night }} night</td>
                @endif
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px; background-color: rgba(249, 249, 249, 0.856)">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Room Price</th>
                <td style="text-align: right;"> {{ $allUserBookingData['room']['price'] }} eur</td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px;">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Price (total)</th>
                <td style="text-align: right;">{{ $allUserBookingData->total_price }} eur</td>
            </tr>
            <tr style="line-height: 1.5; letter-spacing:1px;">
                <th style="text-transform: uppercase; font-weight:lighter; text-align: left;">Payment method</th>
                @if ($allUserBookingData->payment_method === 'Stripe')
                    <td style="text-align: right;">Paid with card</td>
                @elseif ($allUserBookingData->payment_method === 'cash')
                    <td style="text-align: right;">Payment will be made in cash</td>
                @endif
            </tr>
        </table>
    </div>
    <div style="margin-top:5%; border-top:0.5px solid black;width:100%;padding:10px"></div>

    <div style="font-size: 12px; letter-spacing:0.5px; line-height:1.2; text-align:justify">
        <div
            style="text-transform:uppercase; color: rgb(120, 120, 120); font-size:12px; letter-spacing:1px; padding:10px 0">
            Some room
            rules</div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus eveniet deleniti amet. Incidunt repudiandae
            quos delectus, itaque voluptates totam. Adipisci, voluptatem nemo! Totam nostrum quia vitae et ullam
            provident ad.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi iusto voluptates rem modi ipsa consectetur
            accusamus optio atque totam eius harum vitae, repellendus placeat enim minus perspiciatis consequuntur illum
            tenetur possimus. Magni voluptate aliquid officiis, ut, quibusdam excepturi enim perspiciatis atque debitis
            sit ratione tempore?</p>
    </div>





</body>

</html>
