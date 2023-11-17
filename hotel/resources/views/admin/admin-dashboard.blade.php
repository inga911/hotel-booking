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
    <link rel="stylesheet" href="{{ asset('backend/assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/book-area.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/room-types.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/single-room-type.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/create-room.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/edit-booking.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>

<body>
    <div class="container">
        @include('admin.body.sidebar')
        <div class="main-content">
            @yield('admin')
        </div>
    </div>
</body>

<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');
    btn.onclick = function() {
        sidebar.classList.toggle('active');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

</html>
