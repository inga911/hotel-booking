@forelse($randomReview as $testimonial)
    <section class="testimonials-container">
        <div class="container">
            <div class="other-review">
                <div class="review-card">
                    <i class='bx bxs-quote-alt-left review-icon'></i>
                    <p class="review-text">{{ $testimonial->review }}</p>
                    <div class="review-author">
                        <p class="author-name"> - <i>{{ $testimonial->author_name }}</i></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@empty
@endforelse
