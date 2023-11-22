@forelse($bookArea as $book)
    <section class="booking-container">
        <div class="booking-card">
            <div class="to-quick-booking">
                <h1 class="booking-short-title">{{ $book->short_title }}</h1>
                <h3 class="booking-main-title">{{ $book->main_title }}</h3>
                <p class="booking-short-description">{{ $book->short_desc }}</p>
                <div class="review-author">
                    <a href="{{ $book->link_url }}" class="to-quick-booking-link"><i class='bx bxs-bell-ring bx-tada'></i>
                        Quick
                        book</a>
                </div>
            </div>
            <div class="booking-area-img">
                <img src="{{ !empty($book->image) ? url('upload/bookarea/' . $book->image) : url('upload/noimage.jpg') }}"
                    class="booking-area-img" alt="book area">
            </div>

        </div>
    </section>
@empty
@endforelse
