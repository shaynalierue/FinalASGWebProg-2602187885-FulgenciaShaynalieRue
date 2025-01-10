<footer class="bg-dark text-light pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Brand and Description -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase mb-3">Connect Friend</h5>
                <p>Connect with friends, explore professions, and build a strong network. Join us and start your journey today!</p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('homePage') }}" class="text-light text-decoration-none">@lang('lang.home')</a></li>
                    <li><a href="{{ route('friendPage') }}" class="text-light text-decoration-none">@lang('lang.friend')</a></li>
                    <li><a href="{{ route('avatarMarketPage') }}" class="text-light text-decoration-none">Avatar Market</a></li>
                    @auth
                    <li><a href="{{ route('chatPage') }}" class="text-light text-decoration-none">Chat</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-md-12 mb-4">
                <h5 class="text-uppercase mb-3">Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-envelope me-2"></i> support@connectfriend.com</li>
                    <li><i class="bi bi-phone me-2"></i> +123 456 7890</li>
                    <li><i class="bi bi-geo-alt me-2"></i> 123 Connect Street, Network City</li>
                </ul>
            </div>
        </div>
        <hr class="bg-light">

        <!-- Social Media and Copyright -->
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
            </div>
            <div>
                <p class="mb-0">© 2025 Connect Friend. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
