@extends('frontend.main-content')

@section('content')
    <section class="about-hotel-container">
        <div class="about-hero">
            <img src="{{ asset('/upload/bookarea/9721525-photo-1578683010236-d716f9a3f461.jpg') }}" alt="About hero">
            <div class="about-hero-text">
                Lorem ipsum dolor sit, amet consectetur adipisicing.
            </div>

        </div>
        <div class="scroll-watcher"></div>
        <div class="about-main-text">
            <h2>Lorem ipsum dolor sit amet, consectetur adipisicing</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit excepturi iste enim corrupti maiores
                praesentium culpa, repudiandae earum itaque sunt necessitatibus est delectus quasi corporis optio quisquam
                velit eius quo aspernatur assumenda voluptas? Fuga minus harum debitis, temporibus hic laudantium. Optio
                vero modi saepe commodi quaerat fugiat necessitatibus sit reiciendis quo nam minus voluptatibus assumenda
                consequatur, laborum nihil qui unde iste quidem dolorem rerum repellendus? Minima odit, provident, optio ea
                quia tempora numquam obcaecati dolorem, itaque sequi vel deleniti quam delectus dolores blanditiis libero
                voluptates consequuntur non cumque autem. Iste dolor numquam libero sequi molestias. Quis in non maxime
                pariatur.</p>
        </div>

        <div class="about-second-text">
            <img src="{{ asset('/upload/bookarea/9721525-photo-1578683010236-d716f9a3f461.jpg') }}" alt="About second image">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo doloribus id earum facere deserunt! At
                laboriosam similique quidem, qui excepturi minima beatae maxime sint illum dolorum, voluptatibus ratione
                tempore. Qui pariatur non ullam obcaecati doloribus, dolorem neque doloremque voluptate deserunt fuga
                suscipit, vitae at totam, delectus aspernatur numquam eligendi! Quia!</p>
        </div>
        @include('frontend.rooms.book-room-area')
    </section>
@endsection
