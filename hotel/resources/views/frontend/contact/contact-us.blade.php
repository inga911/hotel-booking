@extends('frontend.main-content')

@section('content')
    @include('frontend.body.header')
    @include('frontend.body.errors')
    @include('frontend.body.messages')
    <div>
        <div class="container">
            <div class="row ">
                <h2 class="rooms-section-title">Contact us</h2>

                <div class="contact-form">
                    <form method="POST" action="{{ route('frontend.store.contact') }}">
                        @csrf
                        <div class="row">
                            <div>
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" required
                                        placeholder="Name">

                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" required
                                        placeholder="Email">
                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" required class="form-control"
                                        placeholder="Phone">

                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <input type="text" name="subject" id="subject" class="form-control" required
                                        placeholder="Your Subject">
                                </div>
                            </div>

                            <div>
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required
                                        placeholder="Your Message"></textarea>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="checkin-button contact-btn">
                                    Send Message
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="contact-another pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-another-content">
                        <div class="section-title">
                            <h2 class="rooms-section-title">Contacts Information</h2>
                            <p class="contact-p">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, nihil!
                            </p>
                        </div>

                        <div class="contact-item">
                            <ul>
                                <li>
                                    <i class='bx bx-home-alt'></i>
                                    <div class="contact-info">10 Forest Street Campbell, CA 95008
                                    </div>
                                </li>
                                <li>
                                    <i class='bx bx-phone-call'></i>
                                    <div class="content">
                                        <a href="tel:+27113456789" class="contact-info-links">+27113456789</a>
                                    </div>
                                </li>
                                <li>
                                    <i class='bx bx-envelope'></i>
                                    <div class="content">
                                        <a href="mailto:hotel@booking-example.com"
                                            class="contact-info-links">hotel@booking-example.com</a>
                                    </div>
                                </li>
                            </ul>
                            <img src="{{ asset('/upload') . '/' . 'undraw_contact_us_re_4qqt.svg' }}" class="contact-img"
                                alt="Contact">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
