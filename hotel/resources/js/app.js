import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// LOADER START
window.addEventListener('load', () => {
    const loader = document.getElementById('loader-wrapper');
    if (loader) {
        loader.style.display = 'none';
    }
});
function showLoader() {
    document.getElementById('loader-wrapper').style.display = 'flex';
}

function hideLoader() {
    document.getElementById('loader-wrapper').style.display = 'none';
}

showLoader();
// LOADER END

// HOTEL GALLERY START
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
        button.addEventListener('click', function () {
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

// HOTEL GALLERY END


// HERO START (ADULT AND CHILD INCREASE)
document.addEventListener('DOMContentLoaded', function () {
    let adultsNumberInput = document.getElementById('adultsNumber');
    let increaseAdultsBtn = document.getElementById('increaseAdults');
    let decreaseAdultsBtn = document.getElementById('decreaseAdults');

    let childNumberInput = document.getElementById('childNumber');
    let increaseChildBtn = document.getElementById('increaseChild');
    let decreaseChildsBtn = document.getElementById('decreaseChild');

    increaseAdultsBtn.addEventListener('click', function () {
        let currentValue = parseInt(adultsNumberInput.value, 10);
        adultsNumberInput.value = currentValue + 1;
    });

    increaseChildBtn.addEventListener('click', function () {
        let currentValue = parseInt(childNumberInput.value, 10);
        childNumberInput.value = currentValue + 1;
    });

    decreaseAdultsBtn.addEventListener('click', function () {
        let currentValue = parseInt(adultsNumberInput.value, 10);
        if (currentValue > 1) {
            adultsNumberInput.value = currentValue - 1;
        }
    });

    decreaseChildsBtn.addEventListener('click', function () {
        let currentValue = parseInt(childNumberInput.value, 10);
        if (currentValue > 0) {
            childNumberInput.value = currentValue - 1;
        }
    });
});

// HERO END



// ROOMS (CARD) START
document.addEventListener('DOMContentLoaded', function () {
    const cardsContainer = document.querySelector('.rooms-container__cards');
    const cards = cardsContainer.querySelectorAll('.card');

    if (cards.length === 1) {
        document.querySelector('.card').style.cssText =
            'width: 50%; margin-left: auto; margin-right: auto;';
    }
});
// ROOMS (CARD) END
