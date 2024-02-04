@extends('frontend.main-content')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @include('frontend.body.header')
    <h1 class="show-room-title"><i class='bx bx-chevron-right'></i> {{ $room->room_name }} </h1>
    <div class="show-room">
        <form action="{{ route('frontend.reservation', ['room' => $room]) }}" method="get" id="booking_form"
            class="show-room__form">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <div class="check-in">
                <label>Check-in date</label>
                <input autocomplete="off" type="date" name="check_in" class="" id="check_in"
                    value="{{ request()->input('check_in', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="check-in">
                <label>Check-out date</label>
                <input autocomplete="off" type="date" name="check_out" class="" id="check_out"
                    value="{{ request('check_out', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d') }}"
                    required>
            </div>
            <div class="check-in">
                <label>Guest (Adult)</label>
                <select name="person_adult" class="">
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}"
                            {{ request()->input('person_adult', 1) == $i ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="check-in">
                <label>Guest (Child)</label>
                <select name="person_child" class="">
                    @for ($i = 0; $i <= 6; $i++)
                        <option value="{{ $i }}"
                            {{ request()->input('person_child', 0) == $i ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <table>
                <tr>
                    <th>Night:</th>
                    <td><span class="count">x</span><span class="table_total_night">1</span>
                    </td>
                </tr>
                <tr>
                    <th>One Night:</th>
                    <td><span class="table_price_per_night">{{ $room->price }}</span>
                        <i class='bx bx-euro reservation-bx'></i>
                    </td>
                </tr>
                <tr>
                    <th>In Total:</th>
                    <td><span class="table_total_price">0</span>
                        <i class='bx bx-euro reservation-bx'></i>
                    </td>
                </tr>
            </table>
            <button type="submit" class="show-room-btn">BOOK NOW</button>
        </form>

        <dialog class="modal" id="modal">
            <h2>Image name</h2>
            <img src="" alt="">
            <button class="button close-button">X</button>
            <button class="button prev-button"><i class='bx bx-left-arrow-alt'></i></button>
            <button class="button next-button"><i class='bx bx-right-arrow-alt'></i></button>
            <div class="photo-count"></div>
        </dialog>

        <div class="about-room">
            <div>
                @if (count($room->gallery) > 0)
                    <div class="photo-gallery">
                        @foreach ($room->gallery as $key => $photo)
                            <button class="btn-img">
                                <img src="{{ asset('/upload/room_photos') . '/' . $photo->room_photo }}"
                                    class="show-room-photo image" alt="room-{{ $key + 1 }}">
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="photo-gallery">
                        <img src="{{ asset('/upload') . '/' . 'noimage.jpg' }}" class="show-room-photo" alt="room-1">
                    </div>
                @endif
            </div>
            <div class="room-info">
                <div>
                    <i class='bx bx-male-female'></i>
                    Adult {{ $room->total_adult }}
                </div>
                <div>
                    <i class='bx bxs-hotel'></i>
                    {{ $room->bed_style }} bed
                </div>
                @if ($room->total_child > 0)
                    <div>
                        <i class='bx bx-child'></i>
                        Child: {{ $room->total_child }}
                        ({{ $room->extra_child_bed }} extra bed)
                    </div>
                @endif
                <div>
                    <i class='bx bx-euro card-bx'></i>
                    {{ $room->price }}
                </div>
            </div>
            <div class="long-description"><b>About room:</b> {{ $room->room_description }}</div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        let check_in = "{{ request()->input('check_in', date('Y-m-d')) }}";
        let check_out = "{{ request()->input('check_out', date('Y-m-d', strtotime('+1 day'))) }}";
        let room_price = parseFloat("{{ $room->price }}");

        updatePrice(check_in, check_out, room_price);

        $("#check_in, #check_out").on('change', function() {
            let check_in = $("#check_in").val();
            let check_out = $("#check_out").val();
            updatePrice(check_in, check_out, room_price);
        });
    });

    function updatePrice(check_in, check_out, room_price) {
        $.ajax({
            url: "{{ route('check.room.availability') }}",
            data: {
                room_id: "{{ $room->id }}",
                check_in: check_in,
                check_out: check_out
            },
            success: function(data) {
                let total_nights = calculateNights(check_in, check_out);
                let total_price = room_price * total_nights;

                $(".table_total_night").text(total_nights);
                $(".table_total_price").text(total_price.toFixed(2));
            }
        });
    }

    function calculateNights(check_in, check_out) {
        let checkInDate = new Date(check_in);
        let checkOutDate = new Date(check_out);
        let timeDifference = checkOutDate - checkInDate;
        let totalNights = Math.ceil(timeDifference / (1000 * 3600 * 24));
        return totalNights;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.querySelector('.modal');
        const modalImage = modal.querySelector('img');
        const modalTitle = modal.querySelector('h2');
        const photoCountElement = modal.querySelector('.photo-count');
        const images = document.querySelectorAll('.btn-img img');
        let currentIndex = 0;

        const updatePhotoCount = () => {
            photoCountElement.textContent =
                `Photo ${currentIndex + 1} of ${images.length}`;
        };

        const openModalButtons = document.querySelectorAll('.btn-img');
        const closeModalButton = document.querySelector('.close-button');
        const prevButton = modal.querySelector('.prev-button');
        const nextButton = modal.querySelector('.next-button');

        openModalButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                const imageSrc = this.querySelector('img').src;
                const imageAlt = this.querySelector('img').alt;

                modalImage.src = imageSrc;
                modalTitle.textContent = imageAlt;
                modal.showModal();
                modal.classList.remove('closing');
                currentIndex = index;
                updatePhotoCount();
            });
        });

        const showPrevImage = () => {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = images.length - 1;
            }
            const imageSrc = images[currentIndex].src;
            const imageAlt = images[currentIndex].alt;
            modalImage.src = imageSrc;
            modalTitle.textContent = imageAlt;
            updatePhotoCount();
        };

        const showNextImage = () => {
            if (currentIndex < images.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            const imageSrc = images[currentIndex].src;
            const imageAlt = images[currentIndex].alt;
            modalImage.src = imageSrc;
            modalTitle.textContent = imageAlt;
            updatePhotoCount();
        };

        prevButton.addEventListener('click', showPrevImage);
        nextButton.addEventListener('click', showNextImage);

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('closing');
            setTimeout(() => {
                modal.close();
                modal.classList.remove('closing');
            }, 500);
        });
    });
</script>
