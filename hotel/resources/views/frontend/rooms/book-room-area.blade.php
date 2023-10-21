<section class="testimonials-container">
    <div class="container">
        <div class="main-review">
            @forelse($bookArea as $book)
                <div class="review-slide">
                    <h1>{{ $book->short_title }}</h1>
                    <h3>{{ $book->main_title }}</h3>
                    <p>{{ $book->short_desc }}</p>
                    <div class="review-author">
                        <a href="{{ $book->link_url }}">Quick book</a>
                    </div>
                </div>
            @empty
                <li class="">
                    <div></div>
                </li>
            @endforelse
            <img src="{{ asset('frontend/assets/images/hero-section/hero.jpg') }}" class="main-review-img" alt="Review">
        </div>

    </div>
</section>
