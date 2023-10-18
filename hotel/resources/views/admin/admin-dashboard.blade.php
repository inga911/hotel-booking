<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN</title>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/js/app.js') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    @include('admin.body.sidebar')
    <div class="main-content">
        <div class="container">
            @yield('admin')
        </div>
        @include('admin.body.footer')
    </div>
</body>
<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');
    btn.onclick = function() {
        sidebar.classList.toggle('active');
    }
</script>

</html>
