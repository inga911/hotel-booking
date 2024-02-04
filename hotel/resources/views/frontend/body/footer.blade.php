<footer>
    <div class="footer-container">
        <img src="{{ asset('frontend/assets/images/logo/logo.jpg') }}" alt="logo" class="footer-container--logo">
        <div class="footer-container--links">
            <a href="{{ route('frontend.about.hotel') }}" class="footer-links">About us</a>
            <a href="{{ route('frontend.services.hotel') }}" class="footer-links">Services</a>
            <a href="{{ route('frontend.gallery.hotel') }}" class="footer-links">Gallery</a>
            <a href="{{ route('frontend.privacy.hotel') }}" class="footer-links">Privacy Policy</a>
        </div>
        <div class="footer-container--links">
            <a href="#" class="footer-links"><i class='bx bxl-linkedin-square'></i> Linkedin</a>
            <a href="#" class="footer-links"><i class='bx bxl-instagram'></i> Instagram</a>
            <a href="#" class="footer-links"><i class='bx bxl-facebook-circle'></i> Facebook</a>
        </div>
        <div class="footer-container--contact">
            <div class="contacts">
                <a href=" http://maps.google.com/?q=10 Forest Street
                Campbell, CA 95008" target="_blank"
                    class="contact-link">
                    <i class='bx bx-map'></i>
                    10 Forest Street Campbell, CA 95008
                </a>
            </div>
            <div class="contacts">
                <a href="tel:+27113456789" class="contact-link">
                    <i class='bx bx-phone'></i>
                    +27113456789
                </a>
            </div>
            <div class="contacts">
                <a href="mailto:hotel@booking-example.com" class="contact-link">
                    <i class='bx bx-envelope'></i>
                    hotel@booking-example.com
                </a>
            </div>
        </div>
    </div>
    <div class="copy-rights">
        <p>Copyright @2023. All Rights Reserved by xxx</p>
    </div>
</footer>
