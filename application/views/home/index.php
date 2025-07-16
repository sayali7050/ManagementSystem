
<!-- LuxuryHotel-inspired Home Page -->
<!-- Hero Section with Background Image, Overlay, and Animation -->
<style>
.luxury-hero-bg {
    background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1500&q=80') center center/cover no-repeat;
    position: relative;
    min-height: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.luxury-hero-bg::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(26,35,126,0.7);
    z-index: 1;
}
.luxury-hero-content {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1.2s cubic-bezier(0.23, 1, 0.32, 1);
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
.luxury-cta-bg {
    background: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1500&q=80') center center/cover no-repeat;
    position: relative;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.luxury-cta-bg::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(26,35,126,0.8);
    z-index: 1;
}
.luxury-cta-content {
    position: relative;
    z-index: 2;
    animation: fadeInUp 1.2s cubic-bezier(0.23, 1, 0.32, 1);
}
</style>

<section class="luxury-hero-bg text-white text-center">
    <div class="container luxury-hero-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-3"><i class="fas fa-gem me-2"></i>Welcome to LuxuryHotel</h1>
                <p class="lead mb-4">Experience luxury and comfort at its finest. Book your perfect stay with us and create unforgettable memories.</p>
                <a href="<?php echo base_url('search'); ?>" class="btn btn-light btn-lg px-4 fw-bold shadow">
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
            <?php
                $today = date('Y-m-d');
                $tomorrow = date('Y-m-d', strtotime('+1 day'));
            ?>
            <div class="col-md-3">
                <label for="check_in" class="form-label">Check-in</label>
                <input type="date" class="form-control" id="check_in" name="check_in" value="<?php echo $today; ?>" min="<?php echo $today; ?>" required>
            </div>
            <div class="col-md-3">
                <label for="check_out" class="form-label">Check-out</label>
                <input type="date" class="form-control" id="check_out" name="check_out" value="<?php echo $tomorrow; ?>" min="<?php echo $tomorrow; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="guests" class="form-label">Guests</label>
                <select class="form-select" id="guests" name="guests" required>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($i == 2) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
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
                <h2 class="fw-bold">Why Choose LuxuryHotel?</h2>
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
                        <?php if (!empty($room_type->image_url)): ?>
                            <img src="<?php echo htmlspecialchars($room_type->image_url); ?>" alt="Room Type Image" class="img-fluid rounded-top" style="height:160px; object-fit:cover;">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=800&q=80" alt="Room Type Image" class="img-fluid rounded-top" style="height:160px; object-fit:cover;">
                        <?php endif; ?>
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
                        <?php if (!empty($hotel->image_url)): ?>
                            <img src="<?php echo htmlspecialchars($hotel->image_url); ?>" alt="Hotel Image" class="img-fluid rounded-top" style="height:160px; object-fit:cover;">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1501117716987-c8e1ecb21001?auto=format&fit=crop&w=800&q=80" alt="Hotel Image" class="img-fluid rounded-top" style="height:160px; object-fit:cover;">
                        <?php endif; ?>
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

<!-- Testimonials Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">What Our Guests Say</h2>
                <p class="lead">Real experiences from our valued guests</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Guest" class="rounded-circle me-3" width="64" height="64">
                                    <div>
                                        <h5 class="mb-0">Sarah Williams</h5>
                                        <small class="text-muted">Stayed in Deluxe Suite</small>
                                    </div>
                                </div>
                                <blockquote class="blockquote mb-0">
                                    <p>"Absolutely wonderful experience! The staff was attentive, the room was spotless, and the amenities were top-notch. Will definitely return!"</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Guest" class="rounded-circle me-3" width="64" height="64">
                                    <div>
                                        <h5 class="mb-0">James Lee</h5>
                                        <small class="text-muted">Stayed in Executive Room</small>
                                    </div>
                                </div>
                                <blockquote class="blockquote mb-0">
                                    <p>"The best hotel experience I've ever had. The location was perfect and the food was delicious. Highly recommended!"</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Guest" class="rounded-circle me-3" width="64" height="64">
                                    <div>
                                        <h5 class="mb-0">Maria Garcia</h5>
                                        <small class="text-muted">Stayed in Family Suite</small>
                                    </div>
                                </div>
                                <blockquote class="blockquote mb-0">
                                    <p>"Our family loved every moment. The kids enjoyed the pool and the spa was so relaxing. Thank you for making our vacation special!"</p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 shadow-sm p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Guest" class="rounded-circle me-3" width="64" height="64">
                                    <div>
                                        <h5 class="mb-0">David Smith</h5>
                                        <small class="text-muted">Stayed in Presidential Suite</small>
                                    </div>
                                </div>
                                <blockquote class="blockquote mb-0">
                                    <p>"LuxuryHotel exceeded all my expectations. The concierge service was outstanding and the room was pure luxury."</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">Gallery</h2>
                <p class="lead">Explore our hotels and rooms</p>
            </div>
        </div>
        <div class="row g-3">
            <?php $gallery_images = [
                ["src" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80", "alt" => "Luxury Room"],
                ["src" => "https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=800&q=80", "alt" => "Modern Suite"],
                ["src" => "https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80", "alt" => "Hotel Exterior"],
                ["src" => "https://images.unsplash.com/photo-1501117716987-c8e1ecb21001?auto=format&fit=crop&w=800&q=80", "alt" => "Lobby"],
                ["src" => "https://images.unsplash.com/photo-1517486803000-000000000000?auto=format&fit=crop&w=800&q=80", "alt" => "Pool Area"],
                ["src" => "https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80", "alt" => "Dining"],
            ]; ?>
            <?php foreach ($gallery_images as $idx => $img): ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-imgsrc="<?php echo $img['src']; ?>" data-imgalt="<?php echo $img['alt']; ?>">
                        <img src="<?php echo $img['src']; ?>" alt="<?php echo $img['alt']; ?>" class="img-fluid rounded shadow-sm gallery-thumb mb-2" style="object-fit:cover; height:140px; width:100%;">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center">
                    <img id="galleryModalImg" src="" alt="" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
// Gallery lightbox logic
const galleryModal = document.getElementById('galleryModal');
galleryModal.addEventListener('show.bs.modal', function (event) {
    const trigger = event.relatedTarget;
    const imgSrc = trigger.getAttribute('data-imgsrc');
    const imgAlt = trigger.getAttribute('data-imgalt');
    const modalImg = document.getElementById('galleryModalImg');
    modalImg.src = imgSrc;
    modalImg.alt = imgAlt;
});
</script>

<!-- Animated Counters Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="fw-bold">Our Achievements</h2>
                <p class="lead">Proudly serving guests with excellence</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6 col-md-3 mb-4">
                <h2 class="display-4 fw-bold text-primary" data-count="10000">0</h2>
                <p class="mb-0">Guests Served</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <h2 class="display-4 fw-bold text-primary" data-count="500">0</h2>
                <p class="mb-0">Luxury Rooms</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <h2 class="display-4 fw-bold text-primary" data-count="5">0</h2>
                <p class="mb-0">Premium Hotels</p>
            </div>
            <div class="col-6 col-md-3 mb-4">
                <h2 class="display-4 fw-bold text-primary" data-count="4.8">0</h2>
                <p class="mb-0">Average Rating</p>
            </div>
        </div>
    </div>
</section>
<script>
// Animated counters logic
function animateCounters() {
    document.querySelectorAll('[data-count]').forEach(function(el) {
        const target = parseFloat(el.getAttribute('data-count'));
        const isFloat = el.getAttribute('data-count').indexOf('.') !== -1;
        let count = 0;
        const duration = 1800;
        const step = Math.max(1, Math.floor(target / (duration / 16)));
        function update() {
            if (isFloat) {
                count += 0.05;
                if (count >= target) count = target;
                el.textContent = count.toFixed(1);
            } else {
                count += step;
                if (count >= target) count = target;
                el.textContent = Math.floor(count).toLocaleString();
            }
            if (count < target) {
                requestAnimationFrame(update);
            } else {
                el.textContent = isFloat ? target.toFixed(1) : target.toLocaleString();
            }
        }
        update();
    });
}
window.addEventListener('DOMContentLoaded', animateCounters);
</script>

<!-- CTA Section with Background Image, Overlay, and Animation -->
<section class="luxury-cta-bg text-white text-center">
    <div class="container luxury-cta-content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Ready to Book Your Stay?</h2>
                <p class="lead mb-4">Join thousands of satisfied guests who have experienced our exceptional hospitality.</p>
                <a href="<?php echo base_url('search'); ?>" class="btn btn-light btn-lg me-3 fw-bold shadow">
                    <i class="fas fa-calendar-check"></i> Book Now
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
