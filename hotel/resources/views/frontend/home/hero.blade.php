<div class="container">
    <div class="hero-section">
        <h1 class="hero-section--title">Lorem ipsum dolor sit amet consectetur adipisicing.</h1>
        <form action="{{ route('booking.search') }}" method="get">
            @csrf
            <div class="checkin__form">
                <div class="checkin__form--check">
                    <div class="check-label">Check-in date</div>
                    <input autocomplete="off" type="date" name="check_in" class="check-input"
                        value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="checkin__form--check">
                    <div class="check-label">Check-out date</div>
                    <input autocomplete="off" type="date" name="check_out" class="check-input"
                        value="{{ date('Y-m-d', strtotime('+1 day')) }}" min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="checkin__form--check">
                    <div class="check-label">Adult</div>
                    <select name="person_adult" class="check-input">
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="checkin__form--check">
                    <div class="check-label">Child</div>
                    <select name="person_child" class="check-input">
                        @for ($i = 0; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="checkin-button">Check Availability</button>
            </div>
        </form>
    </div>
</div>
