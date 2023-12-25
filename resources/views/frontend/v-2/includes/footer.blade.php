<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-item-wrap">
                    <a href="#" class="footer-logo-inner">
                        <img src="{{asset('setting/'.$setting->logo)}}" alt="Footer Logo">
                    </a>
                    <div class="footer-contact-info">
                        <div class="footer-item">
                            <p class="item-link">
                                <i class="fas fa-map-marker-alt"></i><strong>Address: </strong>
                                {{$setting->address}}
                            </p>
                        </div>
                        <div class="footer-item">
                            <a href="tel:01648177071" class="item-link">
                                <i class="fas fa-headphones-alt"></i><strong>Call Us:</strong>
                                {{$setting->phone}}
                            </a>
                        </div>
                        <div class="footer-item">
                            <a href="mailto:banggomartbd@gmail.com" class="item-link">
                                <i class="fas fa-envelope"></i><strong>Email:</strong>
                                {{$setting->email}}                                
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-item-wrap">
                    <h4 class="footer-item-title">
                        Policy's
                    </h4>
                    <ul class="footer-service-list">
                        <li class="footer-service-list-item">
                            <a href="{{ url('/privacy-policy') }}" class="footer-service-list-link">
                                Privacy Policy
                            </a>
                        </li>
                        <li class="footer-service-list-item">
                            <a href="{{ url('/term-conditions') }}" class="footer-service-list-link">
                                Terms & Conditions
                            </a>
                        </li>
                        <li class="footer-service-list-item">
                            <a href="{{ url('/refund-policy') }}" class="footer-service-list-link">
                                Refund Policy
                            </a>
                        </li>
                        <li class="footer-service-list-item">
                            <a href="{{ url('/payment-policy') }}" class="footer-service-list-link">
                                Payment Policy
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-item-wrap">
                    <h4 class="footer-item-title">
                        Other Page's
                    </h4>
                    <ul class="footer-service-list">
                        <li class="footer-service-list-item">
                            <a href="{{ url('/about-us') }}" class="footer-service-list-link">
                                About Us
                            </a>
                        </li>
                        <li class="footer-service-list-item">
                            <a href="{{ url('/contact-us') }}" class="footer-service-list-link">
                                Contact Us
                            </a>
                        </li>
                        <li class="footer-service-list-item">
                            <a href="{{ url('/all/blogs') }}" class="footer-service-list-link">
                                Blog
                            </a>
                        </li>
                        <li class="footer-service-list-item">
                            <a href="{{ url('/career') }}" class="footer-service-list-link">
                                Careers
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-bottom-left">
                        <p class="text">
                            © 2023,
                            <strong class="text-brand">Software Engineering</strong>
                            <br>All rights reserved
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 resposive-d-none">
                    <div class="footer-bottom-center">
                        <a href="#" class="hot-number">
                            <i class="fas fa-phone-volume"></i>
                            {{$setting->phone}}
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 resposive-d-none">
                    <div class="footer-bottom-right">
                        <div class="footer-bottom-social-media">
                            <h6 class="title">Follow Us</h6>
                            <a href="{{$setting->facebook}}">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{$setting->instagram}}">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{$setting->youtube}}">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="{{$setting->twitter}}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                        <p class="font-sm">Up to 15% discount on your first subscribe</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
