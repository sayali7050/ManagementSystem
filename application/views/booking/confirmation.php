<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- LuxuryHotel-inspired Booking Confirmation Page -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-check-circle me-2"></i>Booking Confirmed!</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($booking)) { ?>
                        <p class="lead mb-4">Thank you for your booking! Your reservation has been confirmed. Below are your booking details:</p>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Booking Reference:</strong> <?php echo htmlspecialchars($booking['booking_reference']); ?></li>
                            <li class="list-group-item"><strong>Hotel:</strong> <?php echo htmlspecialchars($booking['hotel_name'] ?? ''); ?></li>
                            <li class="list-group-item"><strong>Room:</strong> <?php echo htmlspecialchars($booking['room_number'] ?? ''); ?></li>
                            <li class="list-group-item"><strong>Check-in:</strong> <?php echo htmlspecialchars($booking['check_in_date']); ?></li>
                            <li class="list-group-item"><strong>Check-out:</strong> <?php echo htmlspecialchars($booking['check_out_date']); ?></li>
                            <li class="list-group-item"><strong>Guests:</strong> <?php echo htmlspecialchars($booking['guests']); ?></li>
                            <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></li>
                            <li class="list-group-item"><strong>Total Amount:</strong> $<?php echo number_format($booking['total_amount'], 2); ?></li>
                        </ul>
                        <a href="<?php echo site_url('customer/dashboard'); ?>" class="btn btn-outline-primary">Back to Dashboard</a>
                    <?php } else { ?>
                        <div class="alert alert-danger">Booking details not found.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div> 