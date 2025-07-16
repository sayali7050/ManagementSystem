<!-- LuxuryHotel-inspired Customer Dashboard -->
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-primary text-white rounded-4 p-4 shadow-sm d-flex align-items-center justify-content-between" style="background: linear-gradient(90deg, #1a237e 60%, #1976d2 100%);">
                <div>
                    <h2 class="mb-1">Welcome, <?php echo isset($customer_name) ? htmlspecialchars($customer_name) : 'Customer'; ?>!</h2>
                    <p class="mb-0">We're delighted to have you at our hotel. Explore your dashboard below.</p>
                </div>
                <div>
                    <a href="<?php echo site_url('customer/make_booking'); ?>" class="btn btn-light btn-lg fw-bold shadow">Book a Room</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-circle me-2 text-primary"></i>Your Profile</h5>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Name:</strong> <?php echo isset($customer_name) ? htmlspecialchars($customer_name) : '-'; ?></li>
                        <li><strong>Email:</strong> <?php echo isset($customer_email) ? htmlspecialchars($customer_email) : '-'; ?></li>
                        <li><strong>Phone:</strong> <?php echo isset($customer_phone) ? htmlspecialchars($customer_phone) : '-'; ?></li>
                    </ul>
                    <a href="<?php echo site_url('customer/profile'); ?>" class="btn btn-outline-primary btn-sm">Edit Profile</a>
                </div>
            </div>
        </div>
        <!-- Booking Summary Card -->
        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-check me-2 text-success"></i>Upcoming Bookings</h5>
                    <?php if (!empty($upcoming_bookings)) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Hotel</th>
                                        <th>Room</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($upcoming_bookings as $booking) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['hotel_name']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['room_type'] . ' - Room ' . $booking['room_number']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['check_in_date']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['check_out_date']); ?></td>
                                        <td><span class="badge bg-primary"><?php echo htmlspecialchars($booking['status']); ?></span></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p class="text-muted">No upcoming bookings.</p>
                    <?php } ?>
                    <a href="<?php echo site_url('customer/bookings'); ?>" class="btn btn-link mt-3">View All Bookings</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex gap-3">
            <a href="<?php echo site_url('customer/make_booking'); ?>" class="btn btn-success btn-lg px-4"><i class="fas fa-plus-circle me-2"></i>Make a New Booking</a>
            <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger btn-lg px-4"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
        </div>
    </div>
</div>

<script>
function updateCustomerDashboard() {
    $.getJSON('<?= base_url('customer/dashboard_data') ?>', function(data) {
        // Update upcoming bookings
        let upcomingHtml = '';
        if (data.upcoming_bookings && data.upcoming_bookings.length > 0) {
            data.upcoming_bookings.forEach(function(booking) {
                upcomingHtml += `<tr>
                    <td>${booking.hotel_name}</td>
                    <td>${booking.room_type} - Room ${booking.room_number}</td>
                    <td>${booking.check_in_date}</td>
                    <td>${booking.check_out_date}</td>
                    <td><span class='badge bg-primary'>${booking.status}</span></td>
                </tr>`;
            });
            $(".card:contains('Upcoming Bookings') tbody").html(upcomingHtml);
        } else {
            $(".card:contains('Upcoming Bookings') tbody").html('<tr><td colspan=5 class="text-muted">No upcoming bookings.</td></tr>');
        }
        // Optionally, update stats and other widgets here if present
    });
}
$(document).ready(function() {
    updateCustomerDashboard();
    setInterval(updateCustomerDashboard, 30000); // 30 seconds
});
</script>
