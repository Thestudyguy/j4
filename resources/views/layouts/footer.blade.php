{{-- Footer Section --}}
<footer class="bg-dark text-white pt-5 pb-4" id="footer">
    <div class="container text-md-start">
        <div class="row">
            <!-- Clinic Info -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3 text-info">J4 Dental Clinic</h5>
                <p class="text-light" style="text-align: justify;">
                    Bringing brighter smiles to life. At our clinic, we combine expert care with a gentle touch, offering services that prioritize your comfort and dental health.
                </p>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold text-uppercase mb-3 text-info">Contact</h6>
                <p><i class="bi bi-geo-alt-fill text-info me-2"></i>123 Smile Street, Davao City, Philippines</p>
                <p><i class="bi bi-telephone-fill text-info me-2"></i>(+63) 912 345 6789</p>
                <p><i class="bi bi-envelope-fill text-info me-2"></i>contact@pdentalcare.com</p>
                <p><i class="bi bi-clock-fill text-info me-2"></i>Mon–Sat: 9:00AM – 6:00PM</p>
            </div>

            <!-- Social Media -->
            {{-- <div class="col-md-3 mb-4">
                <h6 class="fw-semibold text-uppercase mb-3 text-info">Follow Us</h6>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white-50" aria-label="Facebook">
                        <i class="bi bi-facebook fs-4"></i>
                    </a>
                    <a href="#" class="text-white-50" aria-label="Instagram">
                        <i class="bi bi-instagram fs-4"></i>
                    </a>
                    <a href="#" class="text-white-50" aria-label="Twitter">
                        <i class="bi bi-twitter-x fs-4"></i>
                    </a>
                    <a href="#" class="text-white-50" aria-label="LinkedIn">
                        <i class="bi bi-linkedin fs-4"></i>
                    </a>
                </div>
            </div> --}}
            <div class="col-md-4 mb-4">
                <h6 class="fw-semibold text-uppercase mb-3 text-info">Received your login details? Sign in now to view your appointments</h6>
                @if (session('error'))
                    <p>{{ session('error') }}</p>
                @endif
                @include('auth.login')
            </div>
                    
            <!-- Social Media -->
            <center class="fw-semibold">Follow us on social media</center>
            <div class="col-md-12 d-flex justify-content-center mt-3">
                <div style="display: flex; gap: 20px;">
                    <a href="#" target="_blank" aria-label="Facebook" style="color: #fff;">
                        <i class="bi bi-facebook fs-4"></i>
                    </a>
                    <a href="#" target="_blank" aria-label="Instagram" style="color: #fff;">
                        <i class="bi bi-instagram fs-4"></i>
                    </a>
                    {{-- <a href="#" target="_blank" aria-label="Twitter" style="color: #fff;">
                        <i class="bi bi-twitter-x fs-4"></i>
                    </a> --}}
                    <a href="#" target="_blank" aria-label="LinkedIn" style="color: #fff;">
                        <i class="bi bi-twitter fs-4"></i>
                        <!-- <i class="fas fa-user"></i> -->
                    </a>
            </div>
            </div>
        </div>

        <hr class="my-4 border-light">

        <div class="text-center">
            <small class="text-secondary">&copy; {{ date('Y') }} J4 Dental Clinic. All rights reserved.</small>
        </div>
    </div>
</footer>
