@extends('frontend.main-content')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <section class="gallery-hotel-container">
        <div class="hotel-gallery">
            <h1>GALLERY</h1>
        </div>

        <dialog class="modal" id="modal">
            <h2>Image name</h2>
            <img src="" alt="">
            <button class="button close-button">X</button>
            <button class="button prev-button"><i class='bx bx-left-arrow-alt'></i></button>
            <button class="button next-button"><i class='bx bx-right-arrow-alt'></i></button>
            <div class="photo-count"></div>
        </dialog>


        <div class="gallery-grid">
            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/bookarea/9721525-photo-1578683010236-d716f9a3f461.jpg') }}"
                    alt="Photo nr.1">
            </button>

            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/room_photos/1146361-pexels-photo-164595.jpeg') }}"
                    alt="Photo nr.2">
            </button>

            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/room_photos/6530693-pexels-photo-6186815.jpg') }}"
                    alt="Photo nr.3">
            </button>

            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/room_photos/9042319-pexels-photo-5998137.jpg') }}"
                    alt="Photo nr.4">
            </button>

            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/room_photos/7717095-pexels-photo-3682238.jpg') }}"
                    alt="Photo nr.5">
            </button>

            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/room_photos/6219045-pexels-photo-6585619.jpg') }}"
                    alt="Photo nr.6">
            </button>

            <button class="btn-img">
                <img class="image" src="{{ asset('/upload/room_photos/9753504-pexels-photo-6434623.jpeg') }}"
                    alt="Photo nr.7">
            </button>

        </div>
    </section>
    <script>
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
@endsection
