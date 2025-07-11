<!-- Page Header -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1><i class="fas fa-phone"></i> Contact Us</h1>
                <p class="lead">Get in touch with our friendly team</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-envelope"></i> Send us a Message</h4>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" 
                                               class="form-control" 
                                               id="name" 
                                               name="name" 
                                               placeholder="Your Full Name"
                                               value="<?php echo set_value('name'); ?>" 
                                               required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               placeholder="your@email.com"
                                               value="<?php echo set_value('email'); ?>" 
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="tel" 
                                               class="form-control" 
                                               id="phone" 
                                               name="phone" 
                                               placeholder="+1 (555) 123-4567"
                                               value="<?php echo set_value('phone'); ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Subject <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        </div>
                                        <select class="form-control" id="subject" name="subject" required>
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
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" 
                                      id="message" 
                                      name="message" 
                                      rows="6" 
                                      placeholder="Please tell us how we can help you..."
                                      required><?php echo set_value('message'); ?></textarea>
                            <small class="form-text text-muted">Please provide as much detail as possible</small>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">
                                Subscribe to our newsletter for special offers and updates
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                        
                        <p class="small text-muted mt-3">
                            <i class="fas fa-clock"></i> We typically respond within 24 hours
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-lg-4">
            <!-- Main Contact Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle"></i> Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-map-marker-alt text-primary"></i> Address</h6>
                        <p class="text-muted mb-0">
                            123 Main Street<br>
                            New York, NY 10001<br>
                            United States
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6><i class="fas fa-phone text-primary"></i> Phone</h6>
                        <p class="text-muted mb-0">
                            Main: <a href="tel:+15551234567">+1 (555) 123-4567</a><br>
                            Reservations: <a href="tel:+15551234568">+1 (555) 123-4568</a>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6><i class="fas fa-envelope text-primary"></i> Email</h6>
                        <p class="text-muted mb-0">
                            General: <a href="mailto:info@hotel.com">info@hotel.com</a><br>
                            Reservations: <a href="mailto:reservations@hotel.com">reservations@hotel.com</a>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6><i class="fas fa-clock text-primary"></i> Hours</h6>
                        <p class="text-muted mb-0">
                            Monday - Friday: 6:00 AM - 10:00 PM<br>
                            Saturday - Sunday: 24/7
                        </p>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6><i class="fas fa-exclamation-triangle text-warning"></i> Emergency Contact</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">For urgent matters or emergencies:</p>
                    <p class="h5 text-danger">
                        <i class="fas fa-phone"></i> +1 (555) 911-HELP
                    </p>
                    <small class="text-muted">Available 24/7</small>
                </div>
            </div>

            <!-- Social Media -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6><i class="fas fa-share-alt"></i> Follow Us</h6>
                </div>
                <div class="card-body text-center">
                    <a href="#" class="btn btn-outline-primary btn-sm mr-2 mb-2">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="#" class="btn btn-outline-info btn-sm mr-2 mb-2">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="#" class="btn btn-outline-danger btn-sm mr-2 mb-2">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="#" class="btn btn-outline-dark btn-sm mb-2">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h6><i class="fas fa-bolt"></i> Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="<?php echo base_url('search'); ?>" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-search"></i> Search Rooms
                    </a>
                    <a href="<?php echo base_url('booking-lookup'); ?>" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-search"></i> Find My Booking
                    </a>
                    <a href="<?php echo base_url('about'); ?>" class="btn btn-outline-secondary btn-block">
                        <i class="fas fa-info-circle"></i> About Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question-circle"></i> Frequently Asked Questions</h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="card">
                            <div class="card-header" id="faq1">
                                <h6 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1">
                                        What are your check-in and check-out times?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse1" class="collapse show" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Check-in time is 3:00 PM and check-out time is 11:00 AM. Early check-in and late check-out may be available upon request, subject to availability.
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header" id="faq2">
                                <h6 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse2">
                                        What is your cancellation policy?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse2" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    You can cancel your reservation up to 24 hours before your check-in date without any charges. Cancellations made within 24 hours will be charged one night's stay.
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header" id="faq3">
                                <h6 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse3">
                                        Do you offer airport transportation?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse3" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Yes, we provide airport shuttle service for an additional fee. Please contact us at least 24 hours in advance to arrange transportation.
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header" id="faq4">
                                <h6 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse4">
                                        Are pets allowed?
                                    </button>
                                </h6>
                            </div>
                            <div id="collapse4" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body">
                                    We welcome well-behaved pets in designated pet-friendly rooms. Additional fees may apply. Please inform us about your pet when making your reservation.
                                </div>
                            </div>
                        </div>
                    </div>
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