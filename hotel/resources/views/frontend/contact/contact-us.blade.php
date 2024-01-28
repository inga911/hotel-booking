@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    @include('frontend.body.errors')
    @include('frontend.body.messages')
    <h2 class="section-title-main">Contact us</h2>
    <form method="POST" action="{{ route('frontend.store.contact') }}" class="contact-form">
        @csrf
        <div class="contact-form__group">
            <input type="text" name="name" id="name" class="contact-form__group--input" required placeholder="Name">

        </div>
        <div class="contact-form__group">
            <input type="email" name="email" id="email" class="contact-form__group--input" required
                placeholder="Email">
        </div>
        <div class="contact-form__group">
            <input type="text" name="phone" id="phone" required class="contact-form__group--input"
                placeholder="Phone">

        </div>
        <div class="contact-form__group">
            <input type="text" name="subject" id="subject" class="contact-form__group--input" required
                placeholder="Your Subject">
        </div>
        <div class="contact-form__group">
            <textarea name="message" class="contact-form__group--input" id="message" cols="30" rows="8" required
                placeholder="Your Message"></textarea>
        </div>

        <button id="msgSubmit" type="submit" class="contact-form__btn">
            Send Message
        </button>
    </form>

    <div class="contact-info">
        <h3 class="section-title-second">Contacts Information</h3>
        <p class="section-paragraph">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, nihil!
        </p>

        <div class="contact-info__item">
            <div class="contact-info__item--column">
                <div class="location">
                    <a href=" http://maps.google.com/?q=10 Forest Street Campbell, CA 95008" target="_blank"
                        class="contact--links">
                        <i class='bx bx-map'></i>
                        10 Forest Street Campbell, CA
                        95008
                    </a>
                </div>
                <div class="contact">
                    <a href="tel:+27113456789" class="contact--links"><i class='bx bx-phone-call'></i>
                        +27113456789</a>
                </div>
                <div class="contact">
                    <a href="mailto:hotel@booking-example.com" class="contact--links"><i class='bx bx-envelope'></i>
                        hotel@booking-example.com</a>
                </div>
            </div>
            <img src="{{ asset('/upload') . '/' . 'undraw_contact_us_re_4qqt.svg' }}" class="contact-info__item--img"
                alt="Contact">
        </div>
    </div>
@endsection
