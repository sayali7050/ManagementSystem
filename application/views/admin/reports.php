<!-- LuxuryHotel Admin - Reports -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Reports & Analytics</h5>
            </div>
            <div class="card-body">
                <!-- Summary Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card bg-gradient-primary text-white border-0">
                            <div class="card-body">
                                <div class="fs-2 mb-2"><i class="fas fa-calendar-check"></i></div>
                                <div class="fw-bold">Total Bookings</div>
                                <div class="fs-4">1,234</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-success text-white border-0">
                            <div class="card-body">
                                <div class="fs-2 mb-2"><i class="fas fa-dollar-sign"></i></div>
                                <div class="fw-bold">Total Revenue</div>
                                <div class="fs-4">$98,765</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-warning text-white border-0">
                            <div class="card-body">
                                <div class="fs-2 mb-2"><i class="fas fa-users"></i></div>
                                <div class="fw-bold">New Customers</div>
                                <div class="fs-4">56</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-danger text-white border-0">
                            <div class="card-body">
                                <div class="fs-2 mb-2"><i class="fas fa-bed"></i></div>
                                <div class="fw-bold">Rooms Booked</div>
                                <div class="fs-4">320</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart -->
                <div class="mb-4">
                    <canvas id="reportChart" height="100"></canvas>
                </div>
                <!-- Recent Activity Table -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Activity</th>
                                <th>User</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-06-20</td>
                                <td><span class="badge bg-success">Booking</span></td>
                                <td>Jane Doe</td>
                                <td>Booked Room 101 at Luxury Suites</td>
                            </tr>
                            <tr>
                                <td>2024-06-19</td>
                                <td><span class="badge bg-warning text-dark">Payment</span></td>
                                <td>John Smith</td>
                                <td>Paid $1,200 for Booking BK2024001234</td>
                            </tr>
                            <tr>
                                <td>2024-06-18</td>
                                <td><span class="badge bg-danger">Cancellation</span></td>
                                <td>Mary Lee</td>
                                <td>Cancelled Booking BK2024001222</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Placeholder chart
$(document).ready(function() {
    const ctx = document.getElementById('reportChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Bookings',
                data: [120, 150, 180, 140, 200, 170],
                backgroundColor: 'rgba(25, 118, 210, 0.7)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script> 