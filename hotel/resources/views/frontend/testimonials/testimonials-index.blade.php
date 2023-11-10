<section class="testimonials-container">
    <div class="container">
        <div class="other-review">
            @forelse($randomReview as $testimonial)
                <div class="review-card">
                    <i class='bx bxs-quote-alt-left review-icon'></i>
                    <p class="review-text">{{ $testimonial->review }}</p>
                    <div class="review-author">
                        <p class="author-name"> - <i>{{ $testimonial->author_name }}</i></p>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    </div>
</section>
