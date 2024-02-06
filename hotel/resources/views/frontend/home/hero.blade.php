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
                <div id="adultsCounter" class="checkin__form--check">
                    <div class="check-label">Adult</div>
                    <button type="button" id="decreaseAdults" class="counter-btn"><i class='bx bx-minus'></i></button>
                    <input type="text" id="adultsNumber" name="person_adult" value="1" class="counter-input"
                        readonly>
                    <button type="button" id="increaseAdults" class="counter-btn"><i class='bx bx-plus'></i></button>
                </div>

                <div id="childCounter" class="checkin__form--check">
                    <div class="check-label">Child</div>
                    <button type="button" id="decreaseChild" class="counter-btn"><i class='bx bx-minus'></i></button>
                    <input type="text" id="childNumber" name="person_child" value="0" class="counter-input"
                        readonly>
                    <button type="button" id="increaseChild" class="counter-btn"><i class='bx bx-plus'></i></button>
                </div>
                <button type="submit" class="checkin-button">Check Availability</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let adultsNumberInput = document.getElementById('adultsNumber');
        let increaseAdultsBtn = document.getElementById('increaseAdults');
        let decreaseAdultsBtn = document.getElementById('decreaseAdults');

        let childNumberInput = document.getElementById('childNumber');
        let increaseChildBtn = document.getElementById('increaseChild');
        let decreaseChildsBtn = document.getElementById('decreaseChild');

        increaseAdultsBtn.addEventListener('click', function() {
            let currentValue = parseInt(adultsNumberInput.value, 10);
            adultsNumberInput.value = currentValue + 1;
        });

        increaseChildBtn.addEventListener('click', function() {
            let currentValue = parseInt(childNumberInput.value, 10);
            childNumberInput.value = currentValue + 1;
        });

        decreaseAdultsBtn.addEventListener('click', function() {
            let currentValue = parseInt(adultsNumberInput.value, 10);
            if (currentValue > 1) {
                adultsNumberInput.value = currentValue - 1;
            }
        });

        decreaseChildsBtn.addEventListener('click', function() {
            let currentValue = parseInt(childNumberInput.value, 10);
            if (currentValue > 0) {
                childNumberInput.value = currentValue - 1;
            }
        });
    });
</script>
