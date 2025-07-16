<!-- LuxuryHotel-inspired Login Page -->
<section class="py-5 bg-primary text-white text-center luxury-hero" style="background: linear-gradient(90deg, #1a237e 60%, #1976d2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-2"><i class="fas fa-sign-in-alt me-2"></i>Login to Your Account</h1>
                <p class="lead mb-0">Welcome back! Please sign in to continue.</p>
            </div>
        </div>
    </div>
</section>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo base_url('login'); ?>" method="POST" id="loginForm">
                        <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                        <div class="mb-3">
                            <label for="login" class="form-label">Email or Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="login" name="login" placeholder="Enter your email or username" value="<?php echo set_value('login'); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3"><i class="fas fa-sign-in-alt me-2"></i>Sign In</button>
                        <div class="text-center">
                            <a href="<?php echo base_url('auth/forgot-password'); ?>" class="text-muted"><i class="fas fa-question-circle"></i> Forgot your password?</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-white">
                    <p class="mb-0">Don't have an account? <a href="<?php echo base_url('register'); ?>" class="fw-bold">Sign up here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
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
    $('#login').focus();
});
</script>