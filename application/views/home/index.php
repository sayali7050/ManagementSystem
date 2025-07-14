
<!-- Hero Section -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Welcome to Our Hotel</h1>
                <p class="lead mb-4">Experience luxury and comfort at its finest. Book your perfect stay with us and create unforgettable memories.</p>
                <a href="<?php echo base_url('search'); ?>" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-search"></i> Search Rooms
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Search Form -->
<div class="container position-relative" style="z-index:2; margin-top:-60px;">
    <div class="bg-white rounded shadow p-4 mx-auto" style="max-width: 700px;">
        <h3 class="text-center mb-4">Find Your Perfect Room</h3>
        <form action="<?php echo base_url('search'); ?>" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="check_in" class="form-label">Check-in</label>
                <input type="date" class="form-control" id="check_in" name="check_in" required>
            </div>
            <div class="col-md-3">
                <label for="check_out" class="form-label">Check-out</label>
                <input type="date" class="form-control" id="check_out" name="check_out" required>
            </div>
            <div class="col-md-2">
                <label for="guests" class="form-label">Guests</label>
                <input type="number" class="form-control" id="guests" name="guests" min="1" value="2" required>
            </div>
            <div class="col-md-4 d-grid">
                <button type="submit" class="btn btn-primary btn-lg mt-2 mt-md-0">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">Why Choose Us?</h2>
                <p class="lead">Exceptional service and world-class amenities</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-wifi fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Free Wi-Fi</h5>
                        <p class="card-text">Stay connected with complimentary high-speed internet throughout the property.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-swimming-pool fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Swimming Pool</h5>
                        <p class="card-text">Relax and unwind in our pristine swimming pool with poolside service.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Fine Dining</h5>
                        <p class="card-text">Enjoy exquisite cuisine at our award-winning restaurant and room service.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Spa & Wellness</h5>
                        <p class="card-text">Rejuvenate your body and mind with our full-service spa treatments.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Fitness Center</h5>
                        <p class="card-text">Stay fit with our state-of-the-art gym equipment and fitness classes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <i class="fas fa-concierge-bell fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">24/7 Concierge</h5>
                        <p class="card-text">Our dedicated concierge team is available round the clock for your needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Room Types Section -->
<?php if (isset($room_types) && !empty($room_types)): ?>
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">Our Room Types</h2>
                <p class="lead">Choose from our variety of comfortable accommodations</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($room_types as $room_type): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $room_type->name; ?></h5>
                            <p class="card-text"><?php echo $room_type->description; ?></p>
                            <div class="mb-3">
                                <span class="h4 text-primary">$<?php echo number_format($room_type->base_price, 2); ?></span>
                                <small class="text-muted">/night</small>
                            </div>
                            <ul class="list-unstyled mb-3">
                                <li><i class="fas fa-users"></i> Up to <?php echo $room_type->max_occupancy; ?> guests</li>
                                <?php if ($room_type->size_sqft): ?>
                                    <li><i class="fas fa-expand-arrows-alt"></i> <?php echo $room_type->size_sqft; ?> sq ft</li>
                                <?php endif; ?>
                            </ul>
                            <a href="<?php echo base_url('search?room_type_id=' . $room_type->id); ?>" class="btn btn-outline-primary">
                                View Availability
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Hotels Section -->
<?php if (isset($hotels) && !empty($hotels)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">Our Hotels</h2>
                <p class="lead">Discover our premium locations</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($hotels as $hotel): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-hotel text-primary me-2"></i> <?php echo $hotel->name; ?></h5>
                            <p class="card-text"><?php echo $hotel->description; ?></p>
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $hotel->city; ?>, <?php echo $hotel->state; ?>
                            </p>
                            <?php if ($hotel->star_rating > 0): ?>
                                <div class="mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo $i <= $hotel->star_rating ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                    <span class="ms-1"><?php echo $hotel->star_rating; ?>/5</span>
                                </div>
                            <?php endif; ?>
                            <a href="<?php echo base_url('search?hotel_id=' . $hotel->id); ?>" class="btn btn-primary">
                                View Rooms
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Ready to Book Your Stay?</h2>
                <p class="lead mb-4">Join thousands of satisfied guests who have experienced our exceptional hospitality.</p>
                <a href="<?php echo base_url('search'); ?>" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-calendar-check"></i> Book Now
                </a>
                <a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-phone"></i> Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Set default dates for search form
var today = new Date();
var tomorrow = new Date();
tomorrow.setDate(today.getDate() + 1);
document.getElementById('check_in').value = today.toISOString().split('T')[0];
document.getElementById('check_out').value = tomorrow.toISOString().split('T')[0];
document.getElementById('check_in').addEventListener('change', function() {
    var checkinDate = new Date(this.value);
    checkinDate.setDate(checkinDate.getDate() + 1);
    document.getElementById('check_out').setAttribute('min', checkinDate.toISOString().split('T')[0]);
});
</script>
