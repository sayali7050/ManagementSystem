<div class="container">
    <div class="row justify-content-center" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h4><i class="fas fa-user-plus"></i> Create Your Account</h4>
                    <p class="text-muted mb-0">Join us today and enjoy our exclusive services</p>
                </div>
                
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo base_url('register'); ?>" method="POST" id="registerForm">
                        <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" 
                                               class="form-control" 
                                               id="first_name" 
                                               name="first_name" 
                                               placeholder="First Name"
                                               value="<?php echo set_value('first_name'); ?>" 
                                               required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" 
                                               class="form-control" 
                                               id="last_name" 
                                               name="last_name" 
                                               placeholder="Last Name"
                                               value="<?php echo set_value('last_name'); ?>" 
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="text" 
                                       class="form-control" 
                                       id="username" 
                                       name="username" 
                                       placeholder="Choose a unique username"
                                       value="<?php echo set_value('username'); ?>" 
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="username-check">
                                        <i class="fas fa-question-circle text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <small class="form-text text-muted">3-50 characters, letters and numbers only</small>
                        </div>
                        
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
                                <div class="input-group-append">
                                    <span class="input-group-text" id="email-check">
                                        <i class="fas fa-question-circle text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
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
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Create a strong password" 
                                               required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="password-strength mt-2" id="password-strength"></div>
                                    <small class="form-text text-muted">Minimum 6 characters</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" 
                                               class="form-control" 
                                               id="confirm_password" 
                                               name="confirm_password" 
                                               placeholder="Confirm your password" 
                                               required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="password-match">
                                                <i class="fas fa-question-circle text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a> 
                                and <a href="#" data-toggle="modal" data-target="#privacyModal">Privacy Policy</a>
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                            <label class="form-check-label" for="newsletter">
                                Subscribe to our newsletter for exclusive offers and updates
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg" id="submitBtn">
                            <i class="fas fa-user-plus"></i> Create Account
                        </button>
                    </form>
                </div>
                
                <div class="card-footer text-center">
                    <p class="mb-0">Already have an account? 
                        <a href="<?php echo base_url('login'); ?>" class="font-weight-bold">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms of Service</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>1. Acceptance of Terms</h6>
                <p>By using our hotel management system, you agree to these terms and conditions.</p>
                
                <h6>2. User Responsibilities</h6>
                <p>Users are responsible for maintaining the confidentiality of their account information.</p>
                
                <h6>3. Booking Terms</h6>
                <p>All bookings are subject to availability and confirmation by the hotel.</p>
                
                <h6>4. Cancellation Policy</h6>
                <p>Cancellations must be made according to the specific hotel's cancellation policy.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Toggle password visibility
    $('#togglePassword').click(function() {
        var passwordField = $('#password');
        var passwordFieldType = passwordField.attr('type');
        var icon = $(this).find('i');
        
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
    
    // Password strength checker
    $('#password').on('input', function() {
        var password = $(this).val();
        var strength = 0;
        var strengthText = '';
        var strengthClass = '';
        
        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        switch(strength) {
            case 0:
            case 1:
                strengthText = 'Very Weak';
                strengthClass = 'text-danger';
                break;
            case 2:
                strengthText = 'Weak';
                strengthClass = 'text-warning';
                break;
            case 3:
                strengthText = 'Fair';
                strengthClass = 'text-info';
                break;
            case 4:
                strengthText = 'Good';
                strengthClass = 'text-success';
                break;
            case 5:
                strengthText = 'Strong';
                strengthClass = 'text-success font-weight-bold';
                break;
        }
        
        $('#password-strength').html('<small class="' + strengthClass + '">Password strength: ' + strengthText + '</small>');
    });
    
    // Password match checker
    $('#confirm_password').on('input', function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        var matchIcon = $('#password-match i');
        
        if (confirmPassword === '') {
            matchIcon.removeClass().addClass('fas fa-question-circle text-muted');
        } else if (password === confirmPassword) {
            matchIcon.removeClass().addClass('fas fa-check-circle text-success');
        } else {
            matchIcon.removeClass().addClass('fas fa-times-circle text-danger');
        }
    });
    
    // Username availability checker
    $('#username').on('blur', function() {
        var username = $(this).val();
        if (username.length >= 3) {
            $('#username-check i').removeClass().addClass('fas fa-spinner fa-spin text-info');
            
            $.ajax({
                url: '<?php echo base_url("auth/check_username"); ?>',
                method: 'POST',
                data: { username: username },
                success: function(response) {
                    var data = JSON.parse(response);
                    var checkIcon = $('#username-check i');
                    
                    if (data.exists) {
                        checkIcon.removeClass().addClass('fas fa-times-circle text-danger');
                        $('#username').addClass('is-invalid');
                    } else {
                        checkIcon.removeClass().addClass('fas fa-check-circle text-success');
                        $('#username').removeClass('is-invalid').addClass('is-valid');
                    }
                }
            });
        }
    });
    
    // Email availability checker
    $('#email').on('blur', function() {
        var email = $(this).val();
        if (email && email.includes('@')) {
            $('#email-check i').removeClass().addClass('fas fa-spinner fa-spin text-info');
            
            $.ajax({
                url: '<?php echo base_url("auth/check_email"); ?>',
                method: 'POST',
                data: { email: email },
                success: function(response) {
                    var data = JSON.parse(response);
                    var checkIcon = $('#email-check i');
                    
                    if (data.exists) {
                        checkIcon.removeClass().addClass('fas fa-times-circle text-danger');
                        $('#email').addClass('is-invalid');
                    } else {
                        checkIcon.removeClass().addClass('fas fa-check-circle text-success');
                        $('#email').removeClass('is-invalid').addClass('is-valid');
                    }
                }
            });
        }
    });
    
    // Form validation
    $('#registerForm').on('submit', function(e) {
        var hasError = false;
        
        // Check required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                hasError = true;
            }
        });
        
        // Check password match
        if ($('#password').val() !== $('#confirm_password').val()) {
            $('#confirm_password').addClass('is-invalid');
            alert('Passwords do not match');
            hasError = true;
        }
        
        // Check password length
        if ($('#password').val().length < 6) {
            $('#password').addClass('is-invalid');
            alert('Password must be at least 6 characters long');
            hasError = true;
        }
        
        if (hasError) {
            e.preventDefault();
            return false;
        }
        
        // Show loading
        $('#submitBtn').html('<i class="fas fa-spinner fa-spin"></i> Creating Account...').prop('disabled', true);
    });
    
    // Real-time validation
    $('input[required]').on('blur', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).addClass('is-invalid');
        }
    });
});
</script>