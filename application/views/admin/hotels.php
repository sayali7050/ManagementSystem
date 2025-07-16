<!-- LuxuryHotel Admin - Hotels Management -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-building me-2"></i>Hotels Management</h5>
                <a href="#" class="btn btn-light btn-sm"><i class="fas fa-plus me-1"></i>New Hotel</a>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <form class="row g-3 mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search by name, city, or address...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="City">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" placeholder="Star Rating" min="1" max="5">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Created from">
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </div>
                </form>
                <!-- Hotels Table -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>Star Rating</th>
                                <th>Status</th>
                                <th>Rooms</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($hotels)) : ?>
                                <?php foreach ($hotels as $hotel) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($hotel->name) ?></td>
                                        <td><?= htmlspecialchars($hotel->city) ?></td>
                                        <td><?= htmlspecialchars($hotel->address) ?></td>
                                        <td>
                                            <span class="text-warning">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?= $i <= $hotel->star_rating ? '' : '-o' ?>"></i>
                                                <?php endfor; ?>
                                            </span>
                                            <?= $hotel->star_rating ?>
                                        </td>
                                        <td><span class="badge <?= $hotel->status === 'active' ? 'bg-success' : 'bg-secondary' ?>"><?= ucfirst($hotel->status) ?></span></td>
                                        <td><?= isset($hotel->room_count) ? $hotel->room_count : '-' ?></td>
                                        <td><?= date('Y-m-d', strtotime($hotel->created_at)) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No hotels found.</td>
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