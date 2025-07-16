<!-- LuxuryHotel-inspired Contact Page -->
<section class="py-5 bg-primary text-white text-center luxury-hero" style="background: linear-gradient(90deg, #1a237e 60%, #1976d2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-2"><i class="fas fa-phone me-2"></i>Contact Us</h1>
                <p class="lead mb-0">Get in touch with our friendly team</p>
            </div>
        </div>
    </div>
</section>
<div class="container my-5">
    <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-envelope me-2"></i>Send us a Message</h4>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo base_url('contact'); ?>" method="POST" id="contactForm">
                        <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Full Name" value="<?php echo set_value('name'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="<?php echo set_value('email'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="+1 (555) 123-4567" value="<?php echo set_value('phone'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                        <option value="General Inquiry" <?php echo set_select('subject', 'General Inquiry'); ?>>General Inquiry</option>
                                        <option value="Booking Assistance" <?php echo set_select('subject', 'Booking Assistance'); ?>>Booking Assistance</option>
                                        <option value="Room Information" <?php echo set_select('subject', 'Room Information'); ?>>Room Information</option>
                                        <option value="Special Requests" <?php echo set_select('subject', 'Special Requests'); ?>>Special Requests</option>
                                        <option value="Feedback" <?php echo set_select('subject', 'Feedback'); ?>>Feedback</option>
                                        <option value="Complaint" <?php echo set_select('subject', 'Complaint'); ?>>Complaint</option>
                                        <option value="Other" <?php echo set_select('subject', 'Other'); ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Please tell us how we can help you..." required><?php echo set_value('message'); ?></textarea>
                            <small class="form-text text-muted">Please provide as much detail as possible</small>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">Subscribe to our newsletter for special offers and updates</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane me-2"></i>Send Message</button>
                        <p class="small text-muted mt-3"><i class="fas fa-clock"></i> We typically respond within 24 hours</p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contact Information -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-map-marker-alt text-primary"></i> Address</h6>
                        <p class="text-muted mb-0">123 Main Street<br>New York, NY 10001<br>United States</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-phone text-primary"></i> Phone</h6>
                        <p class="text-muted mb-0">Main: <a href="tel:+15551234567">+1 (555) 123-4567</a><br>Reservations: <a href="tel:+15551234568">+1 (555) 123-4568</a></p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-envelope text-primary"></i> Email</h6>
                        <p class="text-muted mb-0">General: <a href="mailto:info@hotel.com">info@hotel.com</a><br>Reservations: <a href="mailto:reservations@hotel.com">reservations@hotel.com</a></p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-clock text-primary"></i> Hours</h6>
                        <p class="text-muted mb-0">Monday - Friday: 6:00 AM - 10:00 PM<br>Saturday - Sunday: 24/7</p>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Emergency Contact</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">For urgent matters or emergencies:</p>
                    <p class="h5 text-danger"><i class="fas fa-phone"></i> +1 (555) 911-HELP</p>
                    <small class="text-muted">Available 24/7</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Form validation
    $('#contactForm').on('submit', function(e) {
        var hasError = false;
        
        // Check required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                hasError = true;
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });
        
        // Email validation
        var email = $('#email').val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            $('#email').addClass('is-invalid');
            hasError = true;
        }
        
        if (hasError) {
            e.preventDefault();
            return false;
        }
        
        // Show loading
        $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Sending...').prop('disabled', true);
    });
    
    // Real-time validation
    $('input[required], select[required], textarea[required]').on('blur', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).addClass('is-invalid');
        }
    });
    
    // Character counter for message
    $('#message').on('input', function() {
        var length = $(this).val().length;
        var maxLength = 1000;
        
        if (!$('#charCounter').length) {
            $(this).after('<small id="charCounter" class="form-text text-muted"></small>');
        }
        
        $('#charCounter').text(length + '/' + maxLength + ' characters');
        
        if (length > maxLength) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>