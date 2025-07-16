<!-- LuxuryHotel Admin Dashboard - Bootstrap 5 Refactor -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-gradient-primary text-white h-100" style="background: linear-gradient(90deg, #1a237e 60%, #1976d2 100%);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 mb-2"><i class="fas fa-calendar-check"></i></div>
                    <div class="fw-bold fs-5">Total Bookings</div>
                    <div class="fs-4 fw-bold mb-1"><?= isset($stats['total_bookings']) ? number_format($stats['total_bookings']) : '0' ?></div>
                    <div class="small">All time bookings</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-gradient-success text-white h-100" style="background: linear-gradient(90deg, #43cea2 60%, #185a9d 100%);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 mb-2"><i class="fas fa-bed"></i></div>
                    <div class="fw-bold fs-5">Total Rooms</div>
                    <div class="fs-4 fw-bold mb-1"><?= isset($stats['total_rooms']) ? number_format($stats['total_rooms']) : '0' ?></div>
                    <div class="small">Available rooms</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-gradient-warning text-white h-100" style="background: linear-gradient(90deg, #f7971e 60%, #ffd200 100%);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 mb-2"><i class="fas fa-users"></i></div>
                    <div class="fw-bold fs-5">Total Customers</div>
                    <div class="fs-4 fw-bold mb-1"><?= isset($stats['total_users']) ? number_format($stats['total_users']) : '0' ?></div>
                    <div class="small">Registered users</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-gradient-danger text-white h-100" style="background: linear-gradient(90deg, #e53935 60%, #e35d5b 100%);">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="fs-2 mb-2"><i class="fas fa-building"></i></div>
                    <div class="fw-bold fs-5">Total Hotels</div>
                    <div class="fs-4 fw-bold mb-1"><?= isset($stats['total_hotels']) ? number_format($stats['total_hotels']) : '0' ?></div>
                    <div class="small">Active properties</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Today's Check-ins -->
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Today's Check-ins</h5>
                <span class="badge bg-info fs-6"><?= isset($todays_checkins) ? count($todays_checkins) : 0 ?></span>
            </div>
            <div class="card-body">
                <?php if (isset($todays_checkins) && !empty($todays_checkins)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Room</th>
                                    <th>Guest</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todays_checkins as $checkin): ?>
                                <tr>
                                    <td><?= $checkin->room_number ?></td>
                                    <td><?= $checkin->first_name . ' ' . $checkin->last_name ?></td>
                                    <td><?= $checkin->phone ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="checkInGuest(<?= $checkin->id ?>)">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No check-ins scheduled for today.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Today's Check-outs -->
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-sign-out-alt me-2"></i>Today's Check-outs</h5>
                <span class="badge bg-warning fs-6"><?= isset($todays_checkouts) ? count($todays_checkouts) : 0 ?></span>
            </div>
            <div class="card-body">
                <?php if (isset($todays_checkouts) && !empty($todays_checkouts)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Room</th>
                                    <th>Guest</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todays_checkouts as $checkout): ?>
                                <tr>
                                    <td><?= $checkout->room_number ?></td>
                                    <td><?= $checkout->first_name . ' ' . $checkout->last_name ?></td>
                                    <td><?= $checkout->phone ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="checkOutGuest(<?= $checkout->id ?>)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No check-outs scheduled for today.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Recent Bookings</h5>
                <a href="<?= base_url('admin/bookings') ?>" class="btn btn-outline-light btn-sm">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body">
                <?php if (isset($recent_bookings) && !empty($recent_bookings)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Reference</th>
                                    <th>Guest</th>
                                    <th>Hotel</th>
                                    <th>Room</th>
                                    <th>Check-in</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_bookings as $booking): ?>
                                <tr>
                                    <td><strong><?= $booking->booking_reference ?></strong></td>
                                    <td><?= $booking->first_name . ' ' . $booking->last_name ?></td>
                                    <td><?= $booking->hotel_name ?></td>
                                    <td><?= $booking->room_number ?></td>
                                    <td><?= date('M j, Y', strtotime($booking->check_in_date)) ?></td>
                                    <td>
                                        <?php
                                        $status_class = '';
                                        switch($booking->status) {
                                            case 'confirmed': $status_class = 'success'; break;
                                            case 'pending': $status_class = 'warning'; break;
                                            case 'cancelled': $status_class = 'danger'; break;
                                            case 'completed': $status_class = 'info'; break;
                                            default: $status_class = 'secondary';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $status_class ?>"><?= ucfirst($booking->status) ?></span>
                                    </td>
                                    <td>$<?= number_format($booking->total_amount, 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No recent bookings found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Statistics Chart -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Monthly Statistics</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Chart.js instance (will be updated by AJAX)
let monthlyChart;

function renderMonthlyChart(data) {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    if (monthlyChart) monthlyChart.destroy();
    monthlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Bookings',
                data: data,
                borderColor: '#1976d2',
                backgroundColor: 'rgba(25, 118, 210, 0.1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: { display: true, position: 'top' }
            }
        }
    });
}

function updateDashboardData() {
    $.getJSON('<?= base_url('admin/dashboard_data') ?>', function(data) {
        // Update stats
        $(".card:contains('Total Bookings') .fs-4").text(Number(data.stats.total_bookings).toLocaleString());
        $(".card:contains('Total Rooms') .fs-4").text(Number(data.stats.total_rooms).toLocaleString());
        $(".card:contains('Total Customers') .fs-4").text(Number(data.stats.total_users).toLocaleString());
        $(".card:contains('Total Hotels') .fs-4").text(Number(data.stats.total_hotels).toLocaleString());

        // Update check-ins
        let checkinsHtml = '';
        if (data.todays_checkins && data.todays_checkins.length > 0) {
            data.todays_checkins.forEach(function(checkin) {
                checkinsHtml += `<tr>
                    <td>${checkin.room_number}</td>
                    <td>${checkin.first_name} ${checkin.last_name}</td>
                    <td>${checkin.phone}</td>
                    <td><button class='btn btn-success btn-sm' onclick='checkInGuest(${checkin.id})'><i class='fas fa-check'></i></button></td>
                </tr>`;
            });
            $(".card:contains('Check-ins') .badge.bg-info").text(data.todays_checkins.length);
            $(".card:contains('Check-ins') tbody").html(checkinsHtml);
        } else {
            $(".card:contains('Check-ins') .badge.bg-info").text('0');
            $(".card:contains('Check-ins') tbody").html('<tr><td colspan=4 class="text-muted">No check-ins scheduled for today.</td></tr>');
        }

        // Update check-outs
        let checkoutsHtml = '';
        if (data.todays_checkouts && data.todays_checkouts.length > 0) {
            data.todays_checkouts.forEach(function(checkout) {
                checkoutsHtml += `<tr>
                    <td>${checkout.room_number}</td>
                    <td>${checkout.first_name} ${checkout.last_name}</td>
                    <td>${checkout.phone}</td>
                    <td><button class='btn btn-danger btn-sm' onclick='checkOutGuest(${checkout.id})'><i class='fas fa-times'></i></button></td>
                </tr>`;
            });
            $(".card:contains('Check-outs') .badge.bg-warning").text(data.todays_checkouts.length);
            $(".card:contains('Check-outs') tbody").html(checkoutsHtml);
        } else {
            $(".card:contains('Check-outs') .badge.bg-warning").text('0');
            $(".card:contains('Check-outs') tbody").html('<tr><td colspan=4 class="text-muted">No check-outs scheduled for today.</td></tr>');
        }

        // Update recent bookings
        let bookingsHtml = '';
        if (data.recent_bookings && data.recent_bookings.length > 0) {
            data.recent_bookings.forEach(function(booking) {
                let statusClass = 'secondary';
                switch(booking.status) {
                    case 'confirmed': statusClass = 'success'; break;
                    case 'pending': statusClass = 'warning'; break;
                    case 'cancelled': statusClass = 'danger'; break;
                    case 'completed': statusClass = 'info'; break;
                }
                bookingsHtml += `<tr>
                    <td><strong>${booking.booking_reference}</strong></td>
                    <td>${booking.first_name} ${booking.last_name}</td>
                    <td>${booking.hotel_name}</td>
                    <td>${booking.room_number}</td>
                    <td>${booking.check_in_date ? new Date(booking.check_in_date).toLocaleDateString() : ''}</td>
                    <td><span class='badge bg-${statusClass}'>${booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}</span></td>
                    <td>$${Number(booking.total_amount).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</td>
                </tr>`;
            });
            $(".card:contains('Recent Bookings') tbody").html(bookingsHtml);
        } else {
            $(".card:contains('Recent Bookings') tbody").html('<tr><td colspan=7 class="text-muted">No recent bookings found.</td></tr>');
        }

        // Update monthly chart
        if (data.monthly_stats && data.monthly_stats.by_status && data.monthly_stats.by_status.confirmed) {
            // Example: use confirmed bookings per month if available
            // For now, just use total bookings as a flat line
            let monthlyData = Array(12).fill(data.stats.total_bookings);
            renderMonthlyChart(monthlyData);
        }
    });
}

$(document).ready(function() {
    updateDashboardData();
    setInterval(updateDashboardData, 30000); // 30 seconds
});

// Dashboard functions
function checkInGuest(bookingId) {
    if (confirm('Mark guest as checked in?')) {
        $.post('<?= base_url("admin/update_booking_status") ?>', {
            booking_id: bookingId,
            status: 'checked_in'
        })
        .done(function(response) {
            if (response.success) {
                updateDashboardData();
            } else {
                alert('Failed to update status');
            }
        });
    }
}

function checkOutGuest(bookingId) {
    if (confirm('Mark guest as checked out?')) {
        $.post('<?= base_url("admin/update_booking_status") ?>', {
            booking_id: bookingId,
            status: 'completed'
        })
        .done(function(response) {
            if (response.success) {
                updateDashboardData();
            } else {
                alert('Failed to update status');
            }
        });
    }
}
</script>