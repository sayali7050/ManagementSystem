<!-- LuxuryHotel-inspired Rooms Page -->
<!-- Hero Section -->
<section class="py-5 bg-primary text-white text-center luxury-hero" style="background: linear-gradient(90deg, #1a237e 60%, #1976d2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-2"><i class="fas fa-bed me-2"></i>Browse All Rooms</h1>
                <p class="lead mb-3">Explore our complete collection of luxury accommodations</p>
                <a href="<?php echo base_url(); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-search me-2"></i>Search by Date
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Add spinner above results -->
<div id="filter-loading-spinner" class="text-center my-3" style="display:none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Sidebar Filter -->
        <div class="col-lg-3">
            <div class="card shadow rounded-4 mb-4 border-0">
                <div class="card-body">
                    <form action="<?php echo base_url('rooms'); ?>" method="GET" id="filterForm">
                        <!-- Filter Rooms Header -->
                        <div class="mb-4">
                            <span style="color:#000;padding:4px 16px;border-radius:4px;font-size:1.2rem;font-weight:bold;display:inline-block;">Filter Rooms</span>
                        </div>
                        
                        <!-- Hotel Filter -->
                        <div class="mb-3">
                            <span style="color:#000;padding:2px 10px;border-radius:3px;font-weight:500;display:inline-block;">Hotel</span>
                            <select class="form-select mt-2" name="hotel_id">
                                <option value="">All Hotels</option>
                                <?php if (isset($hotels)): ?>
                                    <?php foreach ($hotels as $hotel): ?>
                                        <option value="<?php echo $hotel->id; ?>" <?php echo (isset($search_params['hotel_id']) && $search_params['hotel_id'] == $hotel->id) ? 'selected' : ''; ?>><?php echo $hotel->name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <!-- Room Type Filter -->
                        <div class="mb-3">
                            <span style="color:#000;padding:2px 10px;border-radius:3px;font-weight:500;display:inline-block;">Room Type</span>
                            <select class="form-select mt-2" name="room_type_id">
                                <option value="">All Types</option>
                                <?php if (isset($room_types)): ?>
                                    <?php foreach ($room_types as $room_type): ?>
                                        <option value="<?php echo $room_type->id; ?>" <?php echo (isset($search_params['room_type_id']) && $search_params['room_type_id'] == $room_type->id) ? 'selected' : ''; ?>><?php echo $room_type->name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <!-- Price Range -->
                        <div class="mb-3">
                            <span style="color:#000;padding:2px 10px;border-radius:3px;font-weight:500;display:inline-block;">Price Range</span>
                            <select class="form-select mt-2" name="price_range">
                                <option value="">All Prices</option>
                                <option value="1" <?php echo (isset($search_params['price_range']) && $search_params['price_range'] == '1') ? 'selected' : ''; ?>>$0 - $100</option>
                                <option value="2" <?php echo (isset($search_params['price_range']) && $search_params['price_range'] == '2') ? 'selected' : ''; ?>>$100 - $200</option>
                                <option value="3" <?php echo (isset($search_params['price_range']) && $search_params['price_range'] == '3') ? 'selected' : ''; ?>>$200 - $300</option>
                                <option value="4" <?php echo (isset($search_params['price_range']) && $search_params['price_range'] == '4') ? 'selected' : ''; ?>>$300+</option>
                            </select>
                        </div>
                        
                        <!-- Room Capacity -->
                        <div class="mb-3">
                            <span style="color:#000;padding:2px 10px;border-radius:3px;font-weight:500;display:inline-block;">Room Capacity</span>
                            <select class="form-select mt-2" name="capacity">
                                <option value="">Any Capacity</option>
                                <option value="1" <?php echo (isset($search_params['capacity']) && $search_params['capacity'] == '1') ? 'selected' : ''; ?>>1 Guest</option>
                                <option value="2" <?php echo (isset($search_params['capacity']) && $search_params['capacity'] == '2') ? 'selected' : ''; ?>>2 Guests</option>
                                <option value="3" <?php echo (isset($search_params['capacity']) && $search_params['capacity'] == '3') ? 'selected' : ''; ?>>3 Guests</option>
                                <option value="4" <?php echo (isset($search_params['capacity']) && $search_params['capacity'] == '4') ? 'selected' : ''; ?>>4+ Guests</option>
                            </select>
                        </div>
                        
                        <!-- Room Features -->
                        <div class="mb-3">
                            <span style="color:#000;padding:2px 10px;border-radius:3px;font-weight:500;display:inline-block;">Room Features</span>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="features[]" value="wifi" id="featureWifi" <?php echo (isset($search_params['features']) && in_array('wifi', $search_params['features'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="featureWifi">Free Wi-Fi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="features[]" value="balcony" id="featureBalcony" <?php echo (isset($search_params['features']) && in_array('balcony', $search_params['features'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="featureBalcony">Private Balcony</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="features[]" value="kitchenette" id="featureKitchenette" <?php echo (isset($search_params['features']) && in_array('kitchenette', $search_params['features'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="featureKitchenette">Kitchenette</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Results Section -->
        <div class="col-lg-9">
            <div class="d-flex align-items-center mb-4">
                <span style="color:#000;padding:4px 16px;border-radius:4px;font-size:1.1rem;font-weight:bold;display:inline-block;">Showing <?php echo isset($rooms) ? count($rooms) : 0; ?> rooms</span>
            </div>
            <div class="row" id="roomResults">
                <?php if (isset($rooms) && count($rooms) > 0): ?>
                    <?php foreach ($rooms as $room): ?>
                        <div class="col-md-6 mb-4 room-item" data-price="<?php echo $room->price_per_night; ?>" data-rating="<?php echo $room->star_rating ?? 0; ?>" data-name="<?php echo $room->hotel_name; ?>">
                            <div class="card h-100 border-0 shadow-sm luxury-room-card">
                                <?php if (!empty($room->image_url)): ?>
                                    <img src="<?php echo htmlspecialchars($room->image_url); ?>" alt="Room Image" class="img-fluid rounded-top" style="height:180px; object-fit:cover;">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Room Image" class="img-fluid rounded-top" style="height:180px; object-fit:cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0"><i class="fas fa-bed text-primary"></i> <?php echo $room->room_type_name; ?></h5>
                                        <span class="badge bg-<?php echo $room->status == 'available' ? 'success' : 'warning'; ?>"><?php echo ucfirst($room->status); ?></span>
                                    </div>
                                    <p class="text-muted small mb-2"><i class="fas fa-hotel"></i> <?php echo $room->hotel_name; ?></p>
                                    <div class="mb-2">
                                        <span class="h5 text-primary">$<?php echo number_format($room->price_per_night, 2); ?></span>
                                        <small class="text-muted">/night</small>
                                    </div>
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item me-3"><i class="fas fa-users text-primary"></i> <?php echo $room->max_occupancy; ?> guests</li>
                                        <li class="list-inline-item"><i class="fas fa-door-open text-primary"></i> Room <?php echo $room->room_number; ?></li>
                                    </ul>
                                    <div class="mb-2">
                                        <?php if ($room->star_rating > 0): ?>
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo $i <= $room->star_rating ? 'text-warning' : 'text-muted'; ?>"></i>
                                            <?php endfor; ?>
                                            <span class="ms-1"><?php echo $room->star_rating; ?>/5</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="small text-muted mb-2">Floor <?php echo $room->floor; ?></p>
                                    <a href="<?php echo base_url('rooms/' . $room->id); ?>" class="btn btn-outline-primary btn-sm me-2">View Details</a>
                                    <?php if ($room->status == 'available'): ?>
                                        <a href="<?php echo base_url('booking?room_id=' . $room->id); ?>" class="btn btn-success btn-sm">Book Now</a>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Not Available</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            No rooms found matching your criteria. Please try different filters.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// AJAX filtering logic
$(document).ready(function() {
    function submitFilterForm() {
        $('#filter-loading-spinner').show();
        
        // Get form data
        var formData = $('#filterForm').serialize();
        console.log('Submitting filter data:', formData);
        
        $.ajax({
            url: $('#filterForm').attr('action'),
            type: 'GET',
            data: formData,
            success: function(response) {
                console.log('Filter response received');
                var newResults = $(response).find('#roomResults').html();
                if (newResults) {
                    $('#roomResults').html(newResults);
                } else {
                    $('#roomResults').html('<div class="alert alert-info">No rooms found matching your criteria.</div>');
                }
                $('#filter-loading-spinner').hide();
            },
            error: function(xhr, status, error) {
                console.error('Filter error:', error);
                $('#roomResults').html('<div class="alert alert-danger">Failed to load results. Please try again.</div>');
                $('#filter-loading-spinner').hide();
            }
        });
    }
    
    // Submit on filter change with a small delay to prevent too many requests
    var filterTimeout;
    $('#filterForm input, #filterForm select').on('change', function() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(function() {
            submitFilterForm();
        }, 300);
    });
    
    // Also handle checkbox changes
    $('#filterForm input[type="checkbox"]').on('change', function() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(function() {
            submitFilterForm();
        }, 300);
    });
});
</script> 