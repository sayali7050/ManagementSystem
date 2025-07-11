<!-- Page Header -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1><i class="fas fa-search"></i> Find Your Booking</h1>
                <p class="lead">Retrieve your reservation details using your booking reference and email</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Booking Lookup</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Search Form -->
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-ticket-alt"></i> Enter Your Booking Details</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('booking-lookup'); ?>" method="POST" id="lookupForm">
                        <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="booking_reference">Booking Reference <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                                        </div>
                                        <input type="text" 
                                               class="form-control" 
                                               id="booking_reference" 
                                               name="booking_reference" 
                                               placeholder="e.g., BK2024123456"
                                               value="<?php echo set_value('booking_reference'); ?>" 
                                               required>
                                    </div>
                                    <small class="form-text text-muted">Found in your confirmation email</small>
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
                                    <small class="form-text text-muted">Used when making the booking</small>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-search"></i> Find My Booking
                        </button>
                    </form>
                </div>
            </div>

            <!-- Booking Result -->
            <?php if (isset($booking) && $booking): ?>
                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h5><i class="fas fa-check-circle"></i> Booking Found!</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-info-circle text-primary"></i> Booking Information</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Booking Reference:</strong></td>
                                        <td><span class="badge badge-primary"><?php echo $booking->booking_reference; ?></span></td>
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
                                            <span class="badge badge-<?php echo $status_class; ?>">
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
                                    <tr class="font-weight-bold">
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
                                            <span class="badge badge-<?php echo $payment_class; ?>">
                                                <?php echo ucfirst($booking->payment_status); ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar text-info"></i> Important Dates</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Booking Date:</strong></td>
                                        <td><?php echo date('M j, Y g:i A', strtotime($booking->created_at)); ?></td>
                                    </tr>
                                    <?php if (isset($booking->updated_at) && $booking->updated_at != $booking->created_at): ?>
                                    <tr>
                                        <td><strong>Last Updated:</strong></td>
                                        <td><?php echo date('M j, Y g:i A', strtotime($booking->updated_at)); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td><strong>Check-in Time:</strong></td>
                                        <td>3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Check-out Time:</strong></td>
                                        <td>11:00 AM</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <?php if ($booking->special_requests): ?>
                        <div class="row">
                            <div class="col-12">
                                <h6><i class="fas fa-clipboard-list text-warning"></i> Special Requests</h6>
                                <div class="alert alert-info">
                                    <?php echo nl2br(htmlspecialchars($booking->special_requests)); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Action Buttons -->
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <?php if ($booking->status == 'confirmed' && strtotime($booking->check_in_date) > time() + 86400): ?>
                                    <button class="btn btn-warning mr-2" onclick="cancelBooking('<?php echo $booking->booking_reference; ?>')">
                                        <i class="fas fa-times-circle"></i> Cancel Booking
                                    </button>
                                <?php endif; ?>
                                
                                <a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-primary mr-2">
                                    <i class="fas fa-phone"></i> Contact Hotel
                                </a>
                                
                                <button class="btn btn-outline-secondary" onclick="printBooking()">
                                    <i class="fas fa-print"></i> Print Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Error Message -->
            <?php if (isset($error) && $error): ?>
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h5>Booking Not Found</h5>
                        <p class="text-muted"><?php echo $error; ?></p>
                        <p class="small">Please check your booking reference and email address, or contact us for assistance.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Help Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6><i class="fas fa-question-circle"></i> Need Help?</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Can't Find Your Booking?</h6>
                            <ul class="list-unstyled small">
                                <li>• Check your email for the booking confirmation</li>
                                <li>• Verify the booking reference format (e.g., BK2024123456)</li>
                                <li>• Ensure you're using the same email address</li>
                                <li>• Check if the booking was made by someone else</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Contact Information</h6>
                            <p class="small text-muted mb-1">
                                <i class="fas fa-phone"></i> +1 (555) 123-4567
                            </p>
                            <p class="small text-muted mb-1">
                                <i class="fas fa-envelope"></i> reservations@hotel.com
                            </p>
                            <p class="small text-muted">
                                <i class="fas fa-clock"></i> Available 24/7
                            </p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="<?php echo base_url('contact'); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-headset"></i> Contact Support
                        </a>
                        <a href="<?php echo base_url('search'); ?>" class="btn btn-outline-primary btn-sm ml-2">
                            <i class="fas fa-search"></i> Make New Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Form validation
    $('#lookupForm').on('submit', function(e) {
        var reference = $('#booking_reference').val().trim();
        var email = $('#email').val().trim();
        
        if (!reference) {
            alert('Please enter your booking reference');
            $('#booking_reference').focus();
            e.preventDefault();
            return false;
        }
        
        if (!email) {
            alert('Please enter your email address');
            $('#email').focus();
            e.preventDefault();
            return false;
        }
        
        // Show loading
        $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i> Searching...').prop('disabled', true);
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
        // Here you would implement the cancellation logic
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