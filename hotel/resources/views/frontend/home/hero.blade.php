<div class="container">
    <div>
        <img src="{{ asset('frontend/assets/images/hero-section/hero.jpg') }}" alt="Hero image" class="hero-img">
        <h1 class="hero-title">Lorem ipsum dolor sit amet consectetur adipisicing.</h1>
        <form action="{{ route('booking.search') }}" method="get">
            @csrf
            <div class="check-in">
                <div class="check-in-date check">
                    <div class="check-label">Check-in date</div>
                    <input autocomplete="off" type="date" name="check_in" class="check-input"
                        value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="check-out-date check">
                    <div class="check-label">Check-out date</div>
                    <input autocomplete="off" type="date" name="check_out" class="check-input"
                        value="{{ date('Y-m-d', strtotime('+1 day')) }}" min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="guest check">
                    <div class="check-label">Guest (Adult)</div>
                    <select name="person-adult" class="check-input guest-input">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>

                <div class="guest check">
                    <div class="check-label">Guest (Child)</div>
                    <select name="person-child" class="check-input guest-input">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="checkin-button">Check Availability</button>
                </div>
            </div>
        </form>

    </div>
</div>
