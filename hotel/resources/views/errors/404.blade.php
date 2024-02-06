<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main-front.css') }}">
    @vite(['resources/scss/main.scss'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header class="header">
        @include('frontend.body.header')
    </header>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h3>Oops! Page not found</h3>
                <h1><span>4</span><span>0</span><span>4</span></h1>
            </div>
            <h2>we are sorry, but the page you requested was not found</h2>
        </div>
    </div>
    @include('frontend.body.footer')
</body>

</html>
