
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 mb-4">Welcome to Our Hotel</h1>
                <p class="lead mb-4">Experience luxury and comfort at its finest. Book your perfect stay with us and create unforgettable memories.</p>
                <a href="<?php echo base_url('search'); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-search"></i> Search Rooms
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Search Form -->
<div class="container">
    <div class="search-form">
        <h3 class="text-center mb-4">Find Your Perfect Room</h3>
        <form action="<?php echo base_url('search'); ?>" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="check_in">Check-in Date</label>
                        <input type="date" class="form-control" id="check_in" name="check_in" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="check_out">Check-out Date</label>
                        <input type="date" class="form-control" id="check_out" name="check_out" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="guests">Guests</label>
                        <select class="form-control" id="guests" name="guests">
                            <option value="1">1 Guest</option>
                            <option value="2" selected>2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5+ Guests</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="hotel_id">Hotel</label>
                        <select class="form-control" id="hotel_id" name="hotel_id">
                            <option value="">All Hotels</option>
                            <?php if (isset($hotels)): ?>
                                <?php foreach ($hotels as $hotel): ?>
                                    <option value="<?php echo $hotel->id; ?>"><?php echo $hotel->name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2>Why Choose Our Hotel?</h2>
                <p class="lead">Experience exceptional service and world-class amenities</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-wifi fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Free Wi-Fi</h5>
                        <p class="card-text">Stay connected with complimentary high-speed internet throughout the property.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-swimming-pool fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Swimming Pool</h5>
                        <p class="card-text">Relax and unwind in our pristine swimming pool with poolside service.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Fine Dining</h5>
                        <p class="card-text">Enjoy exquisite cuisine at our award-winning restaurant and room service.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Spa & Wellness</h5>
                        <p class="card-text">Rejuvenate your body and mind with our full-service spa treatments.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Fitness Center</h5>
                        <p class="card-text">Stay fit with our state-of-the-art gym equipment and fitness classes.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center">
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
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2>Our Room Types</h2>
                <p class="lead">Choose from our variety of comfortable accommodations</p>
            </div>
        </div>
        
        <div class="row">
            <?php foreach ($room_types as $room_type): ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card room-card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $room_type->name; ?></h5>
                            <p class="card-text"><?php echo $room_type->description; ?></p>
                            <div class="mb-3">
                                <span class="h4 text-primary">$<?php echo number_format($room_type->base_price, 2); ?></span>
                                <small class="text-muted">/night</small>
                            </div>
                            <ul class="list-unstyled">
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
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2>Our Hotels</h2>
                <p class="lead">Discover our premium locations</p>
            </div>
        </div>
        
        <div class="row">
            <?php foreach ($hotels as $hotel): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card room-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-hotel text-primary"></i> <?php echo $hotel->name; ?>
                            </h5>
                            <p class="card-text"><?php echo $hotel->description; ?></p>
                            <p class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $hotel->city; ?>, <?php echo $hotel->state; ?>
                            </p>
                            <?php if ($hotel->rating > 0): ?>
                                <div class="mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo $i <= $hotel->rating ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                    <span class="ml-1"><?php echo $hotel->rating; ?>/5</span>
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
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2>Ready to Book Your Stay?</h2>
                <p class="lead mb-4">Join thousands of satisfied guests who have experienced our exceptional hospitality.</p>
                <a href="<?php echo base_url('search'); ?>" class="btn btn-light btn-lg mr-3">
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
$(document).ready(function() {
    // Set default dates
    var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    
    $('#check_in').val(today.toISOString().split('T')[0]);
    $('#check_out').val(tomorrow.toISOString().split('T')[0]);
    
    // Update minimum checkout date when checkin changes
    $('#check_in').on('change', function() {
        var checkinDate = new Date($(this).val());
        checkinDate.setDate(checkinDate.getDate() + 1);
        $('#check_out').attr('min', checkinDate.toISOString().split('T')[0]);
    });
});
</script>
