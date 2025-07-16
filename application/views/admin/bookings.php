<!-- LuxuryHotel Admin - Bookings Management -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Bookings Management</h5>
                <a href="#" class="btn btn-light btn-sm"><i class="fas fa-plus me-1"></i>New Booking</a>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <form class="row g-3 mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search by guest, hotel, or reference...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Status</option>
                            <option>Confirmed</option>
                            <option>Pending</option>
                            <option>Cancelled</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Payment</option>
                            <option>Paid</option>
                            <option>Pending</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Check-in from">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Check-in to">
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </div>
                </form>
                <!-- Bookings Table -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Reference</th>
                                <th>Guest</th>
                                <th>Hotel</th>
                                <th>Room</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample row -->
                            <tr>
                                <td><strong>BK2024001234</strong></td>
                                <td>Jane Doe</td>
                                <td>Luxury Suites</td>
                                <td>101</td>
                                <td>2024-07-01</td>
                                <td>2024-07-05</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>$1,200.00</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i></a>
                                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            <!-- More rows can be dynamically generated here -->
                        </tbody>
                    </table>
                </div>
                <!-- Pagination (placeholder) -->
                <nav class="mt-3">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div> 