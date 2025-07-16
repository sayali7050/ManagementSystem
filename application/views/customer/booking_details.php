<!-- LuxuryHotel-inspired Booking Details Page -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-file-invoice me-2"></i>Booking Details</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($booking)) { ?>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Booking Reference:</strong> <?php echo htmlspecialchars($booking['booking_reference']); ?></li>
                            <li class="list-group-item"><strong>Hotel:</strong> <?php echo htmlspecialchars($booking['hotel']); ?></li>
                            <li class="list-group-item"><strong>Room:</strong> <?php echo htmlspecialchars($booking['room']); ?></li>
                            <li class="list-group-item"><strong>Check-in:</strong> <?php echo htmlspecialchars($booking['check_in_date']); ?></li>
                            <li class="list-group-item"><strong>Check-out:</strong> <?php echo htmlspecialchars($booking['check_out_date']); ?></li>
                            <li class="list-group-item"><strong>Guests:</strong> <?php echo htmlspecialchars($booking['guests']); ?></li>
                            <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-primary"><?php echo htmlspecialchars($booking['booking_status']); ?></span></li>
                            <li class="list-group-item"><strong>Total Amount:</strong> $<?php echo number_format($booking['total_amount'], 2); ?></li>
                        </ul>
                        <a href="<?php echo site_url('customer/bookings'); ?>" class="btn btn-outline-primary">Back to My Bookings</a>
                    <?php } else { ?>
                        <p class="text-muted">Booking details not found.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
