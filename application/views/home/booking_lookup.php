<!-- LuxuryHotel-inspired Booking Lookup Page -->
<section class="py-5 bg-primary text-white text-center luxury-hero" style="background: linear-gradient(90deg, #1a237e 60%, #1976d2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-2"><i class="fas fa-search me-2"></i>Find Your Booking</h1>
                <p class="lead mb-0">Retrieve your reservation details using your booking reference and email</p>
            </div>
        </div>
    </div>
</section>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Enter Your Booking Details</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('booking-lookup'); ?>" method="POST" id="lookupForm">
                        <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="booking_reference" class="form-label">Booking Reference <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                                    <input type="text" class="form-control" id="booking_reference" name="booking_reference" placeholder="e.g., BK2024123456" value="<?php echo set_value('booking_reference'); ?>" required>
                                </div>
                                <small class="form-text text-muted">Found in your confirmation email</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="<?php echo set_value('email'); ?>" required>
                                </div>
                                <small class="form-text text-muted">Used when making the booking</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fas fa-search me-2"></i>Find My Booking</button>
                    </form>
                </div>
            </div>
            <div id="lookupResult">
            <?php if (isset($booking) && $booking): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Booking Found!</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-info-circle text-primary"></i> Booking Information</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Booking Reference:</strong></td>
                                        <td><span class="badge bg-primary"><?php echo $booking->booking_reference; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <?php
                                            $status_class = '';
                                            switch($booking->status) {
                                                case 'confirmed': $status_class = 'success'; break;
                                                case 'pending': $status_class = 'warning'; break;
                                                case 'cancelled': $status_class = 'danger'; break;
                                                case 'checked_in': $status_class = 'info'; break;
                                                case 'checked_out': $status_class = 'secondary'; break;
                                                default: $status_class = 'secondary';
                                            }
                                            ?>
                                            <span class="badge bg-<?php echo $status_class; ?>">
                                                <?php echo ucfirst(str_replace('_', ' ', $booking->status)); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Guest Name:</strong></td>
                                        <td><?php echo $booking->first_name . ' ' . $booking->last_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td><?php echo $booking->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td><?php echo $booking->phone ?: 'Not provided'; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-hotel text-primary"></i> Stay Details</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Hotel:</strong></td>
                                        <td><?php echo $booking->hotel_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Room:</strong></td>
                                        <td><?php echo $booking->room_type . ' - Room ' . $booking->room_number; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Check-in:</strong></td>
                                        <td><?php echo date('M j, Y', strtotime($booking->check_in_date)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Check-out:</strong></td>
                                        <td><?php echo date('M j, Y', strtotime($booking->check_out_date)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nights:</strong></td>
                                        <td><?php echo $booking->total_nights; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Guests:</strong></td>
                                        <td><?php echo $booking->guests; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-dollar-sign text-success"></i> Payment Information</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Room Rate:</strong></td>
                                        <td>$<?php echo number_format($booking->room_price, 2); ?> / night</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subtotal:</strong></td>
                                        <td>$<?php echo number_format($booking->room_price * $booking->total_nights, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tax:</strong></td>
                                        <td>$<?php echo number_format($booking->tax_amount, 2); ?></td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td><strong>Total Amount:</strong></td>
                                        <td class="text-primary">$<?php echo number_format($booking->total_amount, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payment Status:</strong></td>
                                        <td>
                                            <?php
                                            $payment_class = '';
                                            switch($booking->payment_status) {
                                                case 'paid': $payment_class = 'success'; break;
                                                case 'pending': $payment_class = 'warning'; break;
                                                case 'failed': $payment_class = 'danger'; break;
                                                default: $payment_class = 'secondary';
                                            }
                                            ?>
                                            <span class="badge bg-<?php echo $payment_class; ?>">
                                                <?php echo ucfirst($booking->payment_status); ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // AJAX booking lookup
    $('#lookupForm').on('submit', function(e) {
        e.preventDefault();
        var reference = $('#booking_reference').val().trim();
        var email = $('#email').val().trim();
        var csrfName = $('input[name="<?php echo $this->security->get_csrf_token_name(); ?>"]').attr('name');
        var csrfHash = $('input[name="<?php echo $this->security->get_csrf_token_name(); ?>"]').val();
        if (!reference) {
            alert('Please enter your booking reference');
            $('#booking_reference').focus();
            return false;
        }
        if (!email) {
            alert('Please enter your email address');
            $('#email').focus();
            return false;
        }
        var $btn = $(this).find('button[type="submit"]');
        $btn.html('<i class="fas fa-spinner fa-spin"></i> Searching...').prop('disabled', true);
        // AJAX POST to /booking-lookup
        $.ajax({
            url: '<?php echo base_url('booking-lookup'); ?>',
            type: 'POST',
            data: {
                booking_reference: reference,
                email: email,
                [csrfName]: csrfHash
            },
            dataType: 'html',
            success: function(response) {
                // Parse the returned HTML and extract the booking result area
                var resultHtml = $(response).find('#lookupResult').html();
                $('#lookupResult').html(resultHtml);
                $btn.html('<i class="fas fa-search me-2"></i>Find My Booking').prop('disabled', false);
            },
            error: function() {
                $('#lookupResult').html('<div class="alert alert-danger mt-3">An error occurred. Please try again.</div>');
                $btn.html('<i class="fas fa-search me-2"></i>Find My Booking').prop('disabled', false);
            }
        });
    });
    // Format booking reference input
    $('#booking_reference').on('input', function() {
        var value = $(this).val().toUpperCase();
        $(this).val(value);
    });
    // Real-time validation
    $('#booking_reference, #email').on('blur', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid').addClass('is-valid');
        } else {
            $(this).addClass('is-invalid');
        }
    });
});
// Cancel booking function
function cancelBooking(bookingReference) {
    if (confirm('Are you sure you want to cancel this booking? This action cannot be undone.')) {
        alert('Cancellation request submitted. You will receive a confirmation email shortly.');
    }
}
// Print booking details
function printBooking() {
    window.print();
}
</script>

<style>
@media print {
    .card-header, .btn, .card:last-child {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>