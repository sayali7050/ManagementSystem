<!-- LuxuryHotel Admin - Users Management -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Users Management</h5>
                <?php if ($this->session->userdata('role') === 'admin' || $this->session->userdata('role') === 'staff'): ?>
                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus me-1"></i>New User
                </button>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <form class="row g-3 mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Search by name, email, or username...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Role</option>
                            <option>Admin</option>
                            <option>Staff</option>
                            <option>Customer</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Registered from">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Registered to">
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </div>
                </form>
                <!-- Users Table -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Registered</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php if (!empty($users)) : ?>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= htmlspecialchars($user->first_name . ' ' . $user->last_name) ?></td>
            <td><?= htmlspecialchars($user->username) ?></td>
            <td><?= htmlspecialchars($user->email) ?></td>
            <td><span class="badge bg-primary"><?= ucfirst($user->role) ?></span></td>
            <td>
                <span class="badge <?= $user->status === 'active' ? 'bg-success' : 'bg-secondary' ?>">
                    <?= ucfirst($user->status) ?>
                </span>
            </td>
            <td><?= date('Y-m-d', strtotime($user->created_at)) ?></td>
            <td><?= $user->last_login ? date('Y-m-d H:i', strtotime($user->last_login)) : '-' ?></td>
            <td>
                <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="8" class="text-center text-muted">No users found.</td>
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="addUserModalLabel"><i class="fas fa-user-plus me-2"></i>Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="<?= base_url('admin/users/add') ?>">
        <div class="modal-body">
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="first_name" required>
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
              <option value="customer">Customer</option>
              <option value="staff">Staff</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add User</button>
        </div>
      </form>
    </div>
  </div>
</div> 