<!DOCTYPE html>

<html>

<head>
    <title></title>
    <meta charset="utf-8" />
    <meta content="width=device-width" name="viewport" />

</head>

<body>
    <div>
        <div>
            <div>
                <div>
                    <h1>Your Hotel Booking<br /> </h1>
                </div>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br />Enim nisl, eget dictum
                        consectetur integer lectus.</p>
                </div>
                <div>
                    <a href="http://www.example.com">
                        DISCOVER
                    </a>
                </div>
            </div>
        </div>
        <div>
            <p>Welcome!</p>
        </div>
        <div>
            <div>
                <div>
                    <p><strong>Hi, </strong><br /><strong>Your Request is confirm on this data. </strong></p>
                    <h4> check in : {{ $booking['check_in'] }}</h4>
                    <h4> check Out : {{ $booking['check_out'] }}</h4>
                    <h4> User Name: {{ $booking['name'] }}</h4>
                    <h4> Email : {{ $booking['email'] }}</h4>
                    <h4> Phone : {{ $booking['phone'] }}</h4>
                    <p>Aliquam purus commodo magnis ipsum dolor sit amet, consectetur adipiscing elit habitasse est
                        in rhoncus libero ut. Aenean viverra fermentum, volutpat, neque amet, justo.<br />Socis
                        natoqu eagnis dist mte dulmuese feugiata lecen erment.</p>
                </div>
            </div>
        </div>
        <div>
            <p>About</p>
        </div>
        <div>
            <p>Contact Us</p>
        </div>
        <div>
            <div>
                <p>Your
                    Street 12, 34567 AB City</p>
                <p>info@example.com </p>
                <p>(+1)
                    123 456 789</p>
            </div>
        </div>
        <p>2022 © All Rights Reserved</p>
    </div>
</body>

</html>
