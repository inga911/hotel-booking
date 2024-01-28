@forelse($bookArea as $book)
    <section class="quickbook-container">
        <div class="quickbook-container__text">
            <h1 class="quickbook-container__text--main-title">{{ $book->short_title }}</h1>
            <h3 class="quickbook-container__text--short-title">{{ $book->main_title }}</h3>
            <p class="quickbook-container__text--description">{{ $book->short_desc }}</p>
            <a href="/" class="quickbook-container__text--link"><i class='bx bxs-bell-ring bx-tada'></i>
                Quick
                book</a>
        </div>
        <img src="{{ !empty($book->image) ? url('upload/bookarea/' . $book->image) : url('upload/noimage.jpg') }}"
            class="quickbook-container--img" alt="book area">
    </section>
@empty
@endforelse
