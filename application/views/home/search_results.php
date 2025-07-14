<!-- Page Header -->
<div class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-search"></i> Search Results</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Search Results</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <!-- Search Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Refine Your Search</h5>
            <form action="<?php echo base_url('search'); ?>" method="GET" class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="check_in">Check-in</label>
                        <input type="date" class="form-control form-control-sm" 
                               id="check_in" name="check_in" 
                               value="<?php echo isset($search_params['check_in']) ? $search_params['check_in'] : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="check_out">Check-out</label>
                        <input type="date" class="form-control form-control-sm" 
                               id="check_out" name="check_out" 
                               value="<?php echo isset($search_params['check_out']) ? $search_params['check_out'] : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="guests">Guests</label>
                        <select class="form-control form-control-sm" id="guests" name="guests">
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <option value="<?php echo $i; ?>" 
                                    <?php echo (isset($search_params['guests']) && $search_params['guests'] == $i) ? 'selected' : ''; ?>>
                                    <?php echo $i; ?> Guest<?php echo $i > 1 ? 's' : ''; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="hotel_id">Hotel</label>
                        <select class="form-control form-control-sm" id="hotel_id" name="hotel_id">
                            <option value="">All Hotels</option>
                            <?php if (isset($hotels)): ?>
                                <?php foreach ($hotels as $hotel): ?>
                                    <option value="<?php echo $hotel->id; ?>" 
                                        <?php echo (isset($search_params['hotel_id']) && $search_params['hotel_id'] == $hotel->id) ? 'selected' : ''; ?>>
                                        <?php echo $hotel->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="room_type_id">Room Type</label>
                        <select class="form-control form-control-sm" id="room_type_id" name="room_type_id">
                            <option value="">All Types</option>
                            <?php if (isset($room_types)): ?>
                                <?php foreach ($room_types as $room_type): ?>
                                    <option value="<?php echo $room_type->id; ?>" 
                                        <?php echo (isset($search_params['room_type_id']) && $search_params['room_type_id'] == $room_type->id) ? 'selected' : ''; ?>>
                                        <?php echo $room_type->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results -->
    <div class="row">
        <div class="col-md-3">
            <!-- Filters Sidebar -->
            <div class="card">
                <div class="card-header">
                    <h6><i class="fas fa-filter"></i> Filters</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('search'); ?>" method="GET" id="filterForm">
                        <!-- Preserve search parameters -->
                        <?php if (isset($search_params)): ?>
                            <?php foreach ($search_params as $key => $value): ?>
                                <?php if (!in_array($key, ['min_price', 'max_price'])): ?>
                                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label>Price Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" class="form-control form-control-sm" 
                                           name="min_price" placeholder="Min" 
                                           value="<?php echo isset($search_params['min_price']) ? $search_params['min_price'] : ''; ?>">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control form-control-sm" 
                                           name="max_price" placeholder="Max" 
                                           value="<?php echo isset($search_params['max_price']) ? $search_params['max_price'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary btn-sm btn-block">
                            Apply Filters
                        </button>
                        
                        <a href="<?php echo base_url('search?' . http_build_query(array_intersect_key($search_params ?? [], array_flip(['check_in', 'check_out', 'guests'])))); ?>" 
                           class="btn btn-outline-secondary btn-sm btn-block mt-2">
                            Clear Filters
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Results Info -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <?php if (isset($rooms) && count($rooms) > 0): ?>
                        <h5><?php echo count($rooms); ?> room<?php echo count($rooms) > 1 ? 's' : ''; ?> found</h5>
                        <?php if (isset($search_params['check_in']) && isset($search_params['check_out'])): ?>
                            <p class="text-muted mb-0">
                                For <?php echo date('M j, Y', strtotime($search_params['check_in'])); ?> - 
                                <?php echo date('M j, Y', strtotime($search_params['check_out'])); ?>
                                <?php if (isset($total_nights)): ?>
                                    (<?php echo $total_nights; ?> night<?php echo $total_nights > 1 ? 's' : ''; ?>)
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    <?php else: ?>
                        <h5>No rooms found</h5>
                        <p class="text-muted">Try adjusting your search criteria</p>
                    <?php endif; ?>
                </div>
                
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
                        <i class="fas fa-sort"></i> Sort by
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="sortResults('price_asc')">Price: Low to High</a>
                        <a class="dropdown-item" href="#" onclick="sortResults('price_desc')">Price: High to Low</a>
                        <a class="dropdown-item" href="#" onclick="sortResults('rating')">Guest Rating</a>
                        <a class="dropdown-item" href="#" onclick="sortResults('name')">Hotel Name</a>
                    </div>
                </div>
            </div>

            <!-- Room Cards -->
            <?php if (isset($rooms) && count($rooms) > 0): ?>
                <div class="row" id="roomResults">
                    <?php foreach ($rooms as $room): ?>
                        <div class="col-md-6 mb-4 room-item" 
                             data-price="<?php echo $room->price_per_night; ?>" 
                             data-rating="<?php echo $room->star_rating ?? 0; ?>" 
                             data-name="<?php echo $room->hotel_name; ?>">
                            <div class="card room-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-bed text-primary"></i> <?php echo $room->room_type_name; ?>
                                        </h6>
                                        <span class="badge badge-success">Available</span>
                                    </div>
                                    
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-hotel"></i> <?php echo $room->hotel_name; ?>
                                    </p>
                                    
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <small class="text-muted">
                                                <i class="fas fa-users"></i> Up to <?php echo $room->max_occupancy; ?> guests
                                            </small>
                                        </div>
                                        <div class="col-6">
                                            <?php if (isset($room->star_rating) && $room->star_rating > 0): ?>
                                                <small class="text-muted">
                                                    <i class="fas fa-star text-warning"></i> <?php echo $room->star_rating; ?>/5
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <span class="h5 text-primary">$<?php echo number_format($room->price_per_night, 2); ?></span>
                                            <small class="text-muted">/night</small>
                                            <?php if (isset($total_nights) && $total_nights > 1): ?>
                                                <br><small class="text-muted">
                                                    Total: $<?php echo number_format($room->price_per_night * $total_nights, 2); ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <a href="<?php echo base_url('rooms/' . $room->id); ?>" 
                                               class="btn btn-outline-primary btn-sm">
                                                View Details
                                            </a>
                                            <?php if (isset($search_params['check_in']) && isset($search_params['check_out'])): ?>
                                                <a href="<?php echo base_url('booking?room_id=' . $room->id . '&check_in=' . $search_params['check_in'] . '&check_out=' . $search_params['check_out'] . '&guests=' . ($search_params['guests'] ?? 2)); ?>" 
                                                   class="btn btn-primary btn-sm">
                                                    Book Now
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- No Results -->
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>No rooms available</h4>
                    <p class="text-muted">We couldn't find any rooms matching your criteria.</p>
                    <div class="mt-4">
                        <h6>Try these suggestions:</h6>
                        <ul class="list-unstyled">
                            <li>• Adjust your check-in and check-out dates</li>
                            <li>• Reduce the number of guests</li>
                            <li>• Expand your price range</li>
                            <li>• Choose a different hotel or remove hotel filter</li>
                        </ul>
                    </div>
                    <a href="<?php echo base_url(); ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-home"></i> Start New Search
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Set minimum dates
    var today = new Date().toISOString().split('T')[0];
    $('#check_in').attr('min', today);
    
    $('#check_in').on('change', function() {
        var checkinDate = new Date($(this).val());
        checkinDate.setDate(checkinDate.getDate() + 1);
        $('#check_out').attr('min', checkinDate.toISOString().split('T')[0]);
    });
});

// Sort functionality
function sortResults(sortBy) {
    var container = $('#roomResults');
    var items = container.children('.room-item').get();
    
    items.sort(function(a, b) {
        var aVal, bVal;
        
        switch(sortBy) {
            case 'price_asc':
                aVal = parseFloat($(a).data('price'));
                bVal = parseFloat($(b).data('price'));
                return aVal - bVal;
            case 'price_desc':
                aVal = parseFloat($(a).data('price'));
                bVal = parseFloat($(b).data('price'));
                return bVal - aVal;
            case 'rating':
                aVal = parseFloat($(a).data('rating')) || 0;
                bVal = parseFloat($(b).data('rating')) || 0;
                return bVal - aVal;
            case 'name':
                aVal = $(a).data('name').toLowerCase();
                bVal = $(b).data('name').toLowerCase();
                return aVal.localeCompare(bVal);
            default:
                return 0;
        }
    });
    
    $.each(items, function(index, item) {
        container.append(item);
    });
}
</script>