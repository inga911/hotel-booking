<div class="container">
    <div>
        <img src="{{ asset('frontend/assets/images/hero-section/hero.jpg') }}" alt="Hero image" class="hero-img">
        <h1 class="hero-title">Lorem ipsum dolor sit amet consectetur adipisicing.</h1>
        {{-- <form action="{{ route('booking.search') }}" method="get"> --}}
        @csrf
        <div class="check-in">
            <div class="check-in-date check">
                <div class="check-label">Check in date</div>
                <input autocomplete="off" type="date" name="check_in" class="check-input " placeholder="yyy-mm-dd"
                    required>
            </div>
            <div class="check-out-date check">
                <div class="check-label">Check out date</div>
                <input autocomplete="off" type="date" name="check_out" class="check-input" placeholder="yyy-mm-dd"
                    required>
            </div>
            <div class="guest check">
                <div class="check-label">Guest</div>
                <select name="person" class="check-input guest-input">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                </select>
            </div>
            <div>
                <button type="submit" class="checkin-button">Check in</button>
            </div>
        </div>
        {{-- </forphpm> --}}
    </div>
</div>
