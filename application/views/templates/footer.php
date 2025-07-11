<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-hotel"></i> Hotel Management</h5>
                <p>Your premier destination for comfortable stays and exceptional service. Experience luxury and convenience at our finest establishments.</p>
                <div class="social-links">
                    <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white mr-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-md-2">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url(); ?>" class="text-light">Home</a></li>
                    <li><a href="<?php echo base_url('search'); ?>" class="text-light">Search Rooms</a></li>
                    <li><a href="<?php echo base_url('about'); ?>" class="text-light">About Us</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>" class="text-light">Contact</a></li>
                </ul>
            </div>
            
            <div class="col-md-2">
                <h6>Services</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Room Service</a></li>
                    <li><a href="#" class="text-light">Spa & Wellness</a></li>
                    <li><a href="#" class="text-light">Restaurant</a></li>
                    <li><a href="#" class="text-light">Event Halls</a></li>
                </ul>
            </div>
            
            <div class="col-md-4">
                <h6>Contact Info</h6>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> 123 Main Street, City, State 12345</li>
                    <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> info@hotel.com</li>
                    <li><i class="fas fa-clock"></i> 24/7 Customer Support</li>
                </ul>
            </div>
        </div>
        
        <hr class="bg-light">
        
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <?php echo date('Y'); ?> Hotel Management System. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="#" class="text-light mr-3">Privacy Policy</a>
                <a href="#" class="text-light mr-3">Terms of Service</a>
                <a href="<?php echo base_url('booking-lookup'); ?>" class="text-light">Find My Booking</a>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript -->
<script>
$(document).ready(function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Set minimum date for date inputs to today
    var today = new Date().toISOString().split('T')[0];
    $('input[type="date"]').attr('min', today);
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });
    
    // Form validation enhancement
    $('form').on('submit', function(e) {
        var hasError = false;
        
        // Check required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                hasError = true;
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });
        
        // Date validation for booking forms
        var checkIn = $('input[name="check_in"]').val();
        var checkOut = $('input[name="check_out"]').val();
        
        if (checkIn && checkOut && checkIn >= checkOut) {
            alert('Check-out date must be after check-in date');
            hasError = true;
        }
        
        if (hasError) {
            e.preventDefault();
        }
    });
    
    // Real-time form validation
    $('input, select, textarea').on('blur', function() {
        if ($(this).attr('required') && !$(this).val()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });
    
    // Price range display
    $('#price_range').on('input', function() {
        $('#price_display').text('$' + $(this).val());
    });
});

// AJAX room availability check
function checkRoomAvailability(roomId, checkIn, checkOut) {
    $.ajax({
        url: '<?php echo base_url("api/availability"); ?>',
        method: 'POST',
        data: {
            room_id: roomId,
            check_in: checkIn,
            check_out: checkOut
        },
        success: function(response) {
            if (response.available) {
                $('#availability_' + roomId).html('<span class="badge badge-success">Available</span>');
            } else {
                $('#availability_' + roomId).html('<span class="badge badge-danger">Not Available</span>');
            }
        }
    });
}

// Loading overlay
function showLoading() {
    $('body').append('<div id="loading-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; justify-content: center; align-items: center;"><div class="spinner-border text-light" style="width: 3rem; height: 3rem;"></div></div>');
}

function hideLoading() {
    $('#loading-overlay').remove();
}
</script>

</body>
</html>