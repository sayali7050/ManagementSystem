<!-- LuxuryHotel Admin - Rooms Management -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-bed me-2"></i>Rooms Management</h5>
                <a href="#" class="btn btn-light btn-sm"><i class="fas fa-plus me-1"></i>New Room</a>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <form class="row g-3 mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search by room number or type...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Status</option>
                            <option>Available</option>
                            <option>Occupied</option>
                            <option>Maintenance</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Hotel Name">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Room Type">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" placeholder="Floor" min="1">
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </div>
                </form>
                <!-- Rooms Table -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Room #</th>
                                <th>Type</th>
                                <th>Hotel</th>
                                <th>Floor</th>
                                <th>Status</th>
                                <th>Price/Night</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rooms)) : ?>
                                <?php foreach ($rooms as $room) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($room->room_number) ?></td>
                                        <td><?= htmlspecialchars($room->room_type_name) ?></td>
                                        <td><?= htmlspecialchars($room->hotel_name) ?></td>
                                        <td><?= htmlspecialchars($room->floor) ?></td>
                                        <td><span class="badge <?= $room->status === 'available' ? 'bg-success' : 'bg-secondary' ?>"><?= ucfirst($room->status) ?></span></td>
                                        <td>$<?= number_format($room->price_per_night, 2) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No rooms found.</td>
                                </tr>
                            <?php endif; ?>
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