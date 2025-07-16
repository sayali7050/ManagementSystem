<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'LuxuryHotel'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .navbar-brand {
            font-weight: bold;
            color: #1a237e !important;
            letter-spacing: 1px;
            font-size: 2rem;
            display: flex;
            align-items: center;
        }
        .navbar-brand .luxury-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .nav-link {
            color: #1a237e !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.2s;
        }
        .nav-link.active, .nav-link:focus, .nav-link:hover {
            color: #1976d2 !important;
        }
        .btn-primary, .btn-primary:visited {
            background: #1976d2 !important;
            border: none;
            border-radius: 2rem;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: #1565c0 !important;
        }
        .navbar-toggler { border: none; }
        .navbar-toggler:focus { box-shadow: none; }
        .navbar-text { color: #1a237e; font-size: 1rem; margin-left: 1rem; }
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: #fff;
                border-radius: 0.5rem;
                margin-top: 0.5rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <i class="fas fa-gem luxury-logo text-primary"></i> LuxuryHotel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('rooms'); ?>">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('search'); ?>">Search Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('about'); ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contact'); ?>">Contact</a>
                </li>
                <?php if ($this->session->userdata('logged_in')): ?>
                    <?php if ($this->session->userdata('role') === 'admin' || $this->session->userdata('role') === 'staff'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">Admin Panel</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('customer/dashboard'); ?>">My Account</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text ms-2">Welcome, <?php echo $this->session->userdata('first_name'); ?>!</span>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('booking-lookup'); ?>">Find Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login'); ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="<?php echo base_url('register'); ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Alert Messages -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($error)): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>