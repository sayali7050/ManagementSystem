<!-- LuxuryHotel-inspired Customer Profile Page -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>My Profile</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Name:</strong> <?php echo isset($user->first_name) ? htmlspecialchars($user->first_name . ' ' . $user->last_name) : '-'; ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?php echo isset($user->email) ? htmlspecialchars($user->email) : '-'; ?></li>
                        <li class="list-group-item"><strong>Phone:</strong> <?php echo isset($user->phone) ? htmlspecialchars($user->phone) : '-'; ?></li>
                    </ul>
                    <h5 class="mb-3">Edit Profile</h5>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($user->first_name) ? htmlspecialchars($user->first_name) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($user->last_name) ? htmlspecialchars($user->last_name) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user->email) ? htmlspecialchars($user->email) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($user->phone) ? htmlspecialchars($user->phone) : ''; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
