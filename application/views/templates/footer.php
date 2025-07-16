<!-- LuxuryHotel-inspired Footer -->
<footer class="footer mt-5 py-4 bg-dark text-light">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold mb-2 d-flex align-items-center"><i class="fas fa-gem me-2 text-primary"></i>LuxuryHotel</h5>
                <p class="small mb-3">Your premier destination for luxury stays and exceptional service. Experience elegance and comfort at our finest hotels.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-primary fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-primary fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-primary fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-primary fs-5"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url(); ?>" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="<?php echo base_url('search'); ?>" class="text-light text-decoration-none">Search Rooms</a></li>
                    <li><a href="<?php echo base_url('about'); ?>" class="text-light text-decoration-none">About Us</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>" class="text-light text-decoration-none">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-2 mb-3">
                <h6 class="fw-bold">Services</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">Room Service</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Spa & Wellness</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Restaurant</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Event Halls</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Contact Info</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1"><i class="fas fa-map-marker-alt me-2 text-primary"></i>123 Main Street, City, State 12345</li>
                    <li class="mb-1"><i class="fas fa-phone me-2 text-primary"></i>+1 (555) 123-4567</li>
                    <li class="mb-1"><i class="fas fa-envelope me-2 text-primary"></i>info@luxuryhotel.com</li>
                    <li><i class="fas fa-clock me-2 text-primary"></i>24/7 Customer Support</li>
                </ul>
            </div>
        </div>
        <hr class="bg-light">
        <div class="row align-items-center">
            <div class="col-md-6 small">
                &copy; <?php echo date('Y'); ?> LuxuryHotel. All rights reserved.
            </div>
            <div class="col-md-6 text-md-end small">
                <a href="#" class="text-primary me-3 text-decoration-none">Privacy Policy</a>
                <a href="#" class="text-primary me-3 text-decoration-none">Terms of Service</a>
                <a href="<?php echo base_url('booking-lookup'); ?>" class="text-primary text-decoration-none">Find My Booking</a>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery and Bootstrap 5 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Auto-hide alerts after 5 seconds
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);
</script>
</body>
</html>