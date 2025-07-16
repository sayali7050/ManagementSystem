<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin Dashboard' ?> - LuxuryHotel Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .admin-navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .admin-navbar .navbar-brand {
            font-weight: bold;
            color: #1a237e !important;
            letter-spacing: 1px;
            font-size: 2rem;
            display: flex;
            align-items: center;
        }
        .admin-navbar .navbar-brand .luxury-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .admin-sidebar {
            background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);
            min-height: 100vh;
            color: #fff;
            padding-top: 2rem;
        }
        .admin-sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .admin-sidebar .nav-link.active, .admin-sidebar .nav-link:focus, .admin-sidebar .nav-link:hover {
            background: #fff;
            color: #1a237e !important;
        }
        .admin-sidebar .nav-icon {
            margin-right: 0.75rem;
        }
        .admin-sidebar .sidebar-user {
            margin-bottom: 2rem;
            text-align: center;
        }
        .admin-sidebar .sidebar-user .fa-user-circle {
            font-size: 2.5rem;
            color: #fff;
        }
        .admin-sidebar .sidebar-user .user-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }
        .admin-sidebar .sidebar-user .user-role {
            font-size: 0.95rem;
            color: #c5cae9;
        }
        .content-wrapper {
            background: #f8fafc;
            min-height: 100vh;
            padding-left: 260px;
        }
        @media (max-width: 991.98px) {
            .content-wrapper { padding-left: 0; }
            .admin-sidebar { position: static; min-height: auto; }
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="admin-sidebar flex-shrink-0 p-3 position-fixed h-100" style="width: 260px;">
        <a class="navbar-brand mb-4 d-flex align-items-center" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-gem luxury-logo text-warning"></i> LuxuryHotel Admin
        </a>
        <div class="sidebar-user mb-4">
            <i class="fas fa-user-circle"></i>
            <div class="user-name mt-2"><?= $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') ?></div>
            <div class="user-role"><?= ucfirst($this->session->userdata('role')) ?></div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/bookings') ?>" class="nav-link <?= ($this->uri->segment(2) == 'bookings') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-calendar-check"></i> Bookings
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/rooms') ?>" class="nav-link <?= ($this->uri->segment(2) == 'rooms') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-bed"></i> Rooms
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/hotels') ?>" class="nav-link <?= ($this->uri->segment(2) == 'hotels') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-building"></i> Hotels
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/users') ?>" class="nav-link <?= ($this->uri->segment(2) == 'users') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-users"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/reports') ?>" class="nav-link <?= ($this->uri->segment(2) == 'reports') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-chart-bar"></i> Reports
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/settings') ?>" class="nav-link <?= ($this->uri->segment(2) == 'settings') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-cog"></i> Settings
                </a>
            </li>
            <li class="nav-item mt-3">
                <a href="<?= base_url() ?>" class="nav-link" target="_blank">
                    <i class="nav-icon fas fa-external-link-alt"></i> View Website
                </a>
            </li>
        </ul>
    </nav>
    <!-- Main Content Wrapper -->
    <div class="content-wrapper flex-grow-1">
        <!-- Top Navbar -->
        <nav class="navbar admin-navbar navbar-expand-lg px-4 py-2 sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-lg-none" href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-gem luxury-logo text-warning"></i> LuxuryHotel Admin
                </a>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <span class="fw-bold text-primary">Welcome, <?= $this->session->userdata('first_name') ?>!</span>
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="adminUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminUserDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('customer/profile') ?>"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/settings') ?>"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Flash Messages -->
        <div class="container-fluid mt-3">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('warning')): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= $this->session->flashdata('warning') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <!-- Main content -->
        <section class="content pt-2 pb-4">
            <div class="container-fluid">