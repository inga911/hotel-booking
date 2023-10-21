<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOTEL</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rooms.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/testimonials.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/book-area.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/user-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/user-profile.css') }}">

</head>

<body>
    @include('frontend.body.header')

    @yield('content')

    @include('frontend.body.footer')

</body>

</html>
