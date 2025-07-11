<div class="container">
    <div class="row justify-content-center" style="margin-top: 80px; margin-bottom: 80px;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h4><i class="fas fa-sign-in-alt"></i> Login to Your Account</h4>
                    <p class="text-muted mb-0">Welcome back! Please sign in to continue.</p>
                </div>
                
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo base_url('login'); ?>" method="POST" id="loginForm">
                        <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                        
                        <div class="form-group">
                            <label for="login">Email or Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" 
                                       class="form-control" 
                                       id="login" 
                                       name="login" 
                                       placeholder="Enter your email or username"
                                       value="<?php echo set_value('login'); ?>" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Enter your password" 
                                       required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </button>
                    </form>
                    
                    <hr>
                    
                    <div class="text-center">
                        <a href="<?php echo base_url('auth/forgot-password'); ?>" class="text-muted">
                            <i class="fas fa-question-circle"></i> Forgot your password?
                        </a>
                    </div>
                </div>
                
                <div class="card-footer text-center">
                    <p class="mb-0">Don't have an account? 
                        <a href="<?php echo base_url('register'); ?>" class="font-weight-bold">Sign up here</a>
                    </p>
                </div>
            </div>
            
            <!-- Quick Demo Login -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title"><i class="fas fa-info-circle text-info"></i> Demo Accounts</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="small mb-1"><strong>Admin Account:</strong></p>
                            <p class="small text-muted">
                                Email: admin@hotel.com<br>
                                Password: password
                            </p>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="fillAdminLogin()">
                                <i class="fas fa-user-shield"></i> Use Admin Login
                            </button>
                        </div>
                    </div>
                </div>
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
    
    // Form validation
    $('#loginForm').on('submit', function(e) {
        var login = $('#login').val().trim();
        var password = $('#password').val();
        
        if (!login) {
            alert('Please enter your email or username');
            $('#login').focus();
            e.preventDefault();
            return false;
        }
        
        if (!password) {
            alert('Please enter your password');
            $('#password').focus();
            e.preventDefault();
            return false;
        }
        
        // Show loading
        $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Signing In...').prop('disabled', true);
    });
    
    // Auto-focus on first input
    $('#login').focus();
});

// Quick demo login function
function fillAdminLogin() {
    $('#login').val('admin@hotel.com');
    $('#password').val('password');
    $('#login').addClass('is-valid');
    $('#password').addClass('is-valid');
}
</script>