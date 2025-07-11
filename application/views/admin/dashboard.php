<div class="row">
    <div class="col-lg-3 col-6">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Bookings</span>
                <span class="info-box-number"><?= isset($stats['total_bookings']) ? number_format($stats['total_bookings']) : '0' ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">All time bookings</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-bed"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Rooms</span>
                <span class="info-box-number"><?= isset($stats['total_rooms']) ? number_format($stats['total_rooms']) : '0' ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 85%"></div>
                </div>
                <span class="progress-description">Available rooms</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Customers</span>
                <span class="info-box-number"><?= isset($stats['total_users']) ? number_format($stats['total_users']) : '0' ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 60%"></div>
                </div>
                <span class="progress-description">Registered users</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fas fa-building"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Hotels</span>
                <span class="info-box-number"><?= isset($stats['total_hotels']) ? number_format($stats['total_hotels']) : '0' ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 90%"></div>
                </div>
                <span class="progress-description">Active properties</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Today's Check-ins -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Today's Check-ins
                </h3>
                <div class="card-tools">
                    <span class="badge badge-info"><?= isset($todays_checkins) ? count($todays_checkins) : 0 ?></span>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($todays_checkins) && !empty($todays_checkins)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
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
                                        <button class="btn btn-sm btn-success" onclick="checkInGuest(<?= $checkin->id ?>)">
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Today's Check-outs
                </h3>
                <div class="card-tools">
                    <span class="badge badge-warning"><?= isset($todays_checkouts) ? count($todays_checkouts) : 0 ?></span>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($todays_checkouts) && !empty($todays_checkouts)): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
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
                                        <button class="btn btn-sm btn-danger" onclick="checkOutGuest(<?= $checkout->id ?>)">
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clock mr-2"></i>
                    Recent Bookings
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('admin/bookings') ?>" class="btn btn-sm btn-primary">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($recent_bookings) && !empty($recent_bookings)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
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
                                        <span class="badge badge-<?= $status_class ?>"><?= ucfirst($booking->status) ?></span>
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-2"></i>
                    Monthly Statistics
                </h3>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Chart.js configuration
$(document).ready(function() {
    // Monthly Statistics Chart
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Bookings',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
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
                location.reload();
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
                location.reload();
            } else {
                alert('Failed to update status');
            }
        });
    }
}
</script>