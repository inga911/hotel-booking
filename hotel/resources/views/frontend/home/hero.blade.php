<div class="container">
    <div class="hero-section">
        <h1 class="hero-title">Lorem ipsum dolor sit amet consectetur adipisicing.</h1>
        <form action="{{ route('booking.search') }}" method="get">
            @csrf
            <div class="check-in check-in-360">
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
                    <div class="check-label">Guest (<i class='bx bx-male-female'></i>)</div>
                    <select name="person_adult" class="check-input guest-input">
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="guest check">
                    <div class="check-label">Guest (<i class='bx bx-child' style="font-size: 15px"></i>)</div>
                    <select name="person_child" class="check-input guest-input">
                        @for ($i = 0; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <button type="submit" class="checkin-button">Check Availability</button>
                </div>
            </div>
        </form>

    </div>
</div>
