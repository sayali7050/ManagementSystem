<!-- LuxuryHotel-inspired Customer Bookings Page -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>My Bookings</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($bookings)) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Booking Ref</th>
                                        <th>Hotel</th>
                                        <th>Room</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $booking) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['booking_reference']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['hotel']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['room']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['check_in_date']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['check_out_date']); ?></td>
                                        <td><span class="badge bg-primary"><?php echo htmlspecialchars($booking['booking_status']); ?></span></td>
                                        <td>
                                            <a href="<?php echo site_url('customer/booking_details/' . $booking['id']); ?>" class="btn btn-outline-primary btn-sm">View</a>
                                            <?php if ($booking['booking_status'] === 'confirmed'): ?>
                                                <a href="<?php echo site_url('booking/cancel/' . $booking['id']); ?>" class="btn btn-outline-danger btn-sm">Cancel</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p class="text-muted">You have no bookings yet.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
