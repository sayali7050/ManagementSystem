<!-- Page Header -->
<div class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('search'); ?>">Search</a></li>
                        <li class="breadcrumb-item active"><?php echo $room->room_type_name; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Room Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Room Header -->
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2><?php echo $room->room_type_name; ?></h2>
                            <p class="text-muted mb-2">
                                <i class="fas fa-hotel"></i> <?php echo $room->hotel_name; ?>
                            </p>
                            <p class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> 
                                <?php echo $room->address; ?>, <?php echo $room->city; ?>
                            </p>
                        </div>
                        <div class="text-right">
                            <?php if ($room->rating > 0): ?>
                                <div class="mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo $i <= $room->rating ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                    <span class="ml-1"><?php echo $room->rating; ?>/5</span>
                                </div>
                            <?php endif; ?>
                            <span class="badge badge-primary">Room <?php echo $room->room_number; ?></span>
                            <span class="badge badge-secondary">Floor <?php echo $room->floor; ?></span>
                        </div>
                    </div>

                    <!-- Room Images Placeholder -->
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card bg-light text-center" style="height: 300px;">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                            <p class="text-muted">Room Image Gallery</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="card bg-light text-center" style="height: 145px;">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card bg-light text-center" style="height: 145px;">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Room Information -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h6><i class="fas fa-info-circle text-primary"></i> Room Details</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-users"></i> Up to <?php echo $room->max_occupancy; ?> guests</li>
                                <li><i class="fas fa-bed"></i> <?php echo $room->room_type_name; ?></li>
                                <li><i class="fas fa-door-open"></i> Room <?php echo $room->room_number; ?></li>
                                <li><i class="fas fa-building"></i> Floor <?php echo $room->floor; ?></li>
                            </ul>
                        </div>
                        
                        <div class="col-md-4">
                            <h6><i class="fas fa-dollar-sign text-success"></i> Pricing</h6>
                            <div class="mb-2">
                                <span class="h4 text-primary">$<?php echo number_format($room->price_per_night, 2); ?></span>
                                <small class="text-muted">/night</small>
                            </div>
                            <p class="small text-muted">Prices may vary based on dates and availability</p>
                        </div>
                        
                        <div class="col-md-4">
                            <h6><i class="fas fa-shield-alt text-info"></i> Status</h6>
                            <span class="badge badge-success badge-pill">
                                <i class="fas fa-check"></i> Available
                            </span>
                            <p class="small text-muted mt-2">Ready for immediate booking</p>
                        </div>
                    </div>

                    <!-- Room Description -->
                    <div class="mb-4">
                        <h6><i class="fas fa-align-left text-primary"></i> Description</h6>
                        <p><?php echo $room->room_type_description ?: 'Experience comfort and luxury in our well-appointed ' . $room->room_type_name . '. Perfect for travelers seeking quality accommodation with modern amenities and exceptional service.'; ?></p>
                        
                        <?php if ($room->description): ?>
                            <p><?php echo $room->description; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Amenities -->
                    <div class="mb-4">
                        <h6><i class="fas fa-concierge-bell text-primary"></i> Amenities</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-wifi text-success"></i> Free Wi-Fi</li>
                                    <li><i class="fas fa-tv text-success"></i> Flat-screen TV</li>
                                    <li><i class="fas fa-snowflake text-success"></i> Air Conditioning</li>
                                    <li><i class="fas fa-bath text-success"></i> Private Bathroom</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-coffee text-success"></i> Coffee/Tea Maker</li>
                                    <li><i class="fas fa-phone text-success"></i> Room Service</li>
                                    <li><i class="fas fa-tshirt text-success"></i> Daily Housekeeping</li>
                                    <li><i class="fas fa-lock text-success"></i> Safe Deposit Box</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Similar Rooms -->
            <?php if (isset($similar_rooms) && !empty($similar_rooms)): ?>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5><i class="fas fa-bed"></i> Similar Rooms</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($similar_rooms as $similar_room): ?>
                                <?php if ($similar_room->id != $room->id): ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo $similar_room->room_type_name; ?></h6>
                                                <p class="text-muted small">Room <?php echo $similar_room->room_number; ?></p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-primary font-weight-bold">
                                                        $<?php echo number_format($similar_room->price_per_night, 2); ?>/night
                                                    </span>
                                                    <a href="<?php echo base_url('rooms/' . $similar_room->id); ?>" class="btn btn-outline-primary btn-sm">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Booking Sidebar -->
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5><i class="fas fa-calendar-check"></i> Book This Room</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('booking'); ?>" method="GET" id="bookingForm">
                        <input type="hidden" name="room_id" value="<?php echo $room->id; ?>">
                        
                        <div class="form-group">
                            <label for="check_in">Check-in Date</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="check_out">Check-out Date</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="guests">Number of Guests</label>
                            <select class="form-control" id="guests" name="guests" required>
                                <?php for ($i = 1; $i <= $room->max_occupancy; $i++): ?>
                                    <option value="<?php echo $i; ?>" <?php echo $i == 2 ? 'selected' : ''; ?>>
                                        <?php echo $i; ?> Guest<?php echo $i > 1 ? 's' : ''; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <!-- Price Calculator -->
                        <div class="bg-light p-3 rounded mb-3" id="priceCalculator" style="display: none;">
                            <div class="d-flex justify-content-between">
                                <span>Room Rate:</span>
                                <span>$<?php echo number_format($room->price_per_night, 2); ?>/night</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Number of Nights:</span>
                                <span id="nightsCount">0</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Subtotal:</span>
                                <span id="subtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Taxes (10%):</span>
                                <span id="taxes">$0.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between font-weight-bold">
                                <span>Total Amount:</span>
                                <span id="totalAmount">$0.00</span>
                            </div>
                        </div>
                        
                        <div class="availability-check mb-3" id="availabilityCheck" style="display: none;">
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin"></i> Checking availability...
                            </div>
                        </div>
                        
                        <div class="availability-result" id="availabilityResult"></div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg" id="bookNowBtn" disabled>
                            <i class="fas fa-calendar-check"></i> Book Now
                        </button>
                        
                        <p class="small text-muted text-center mt-2">
                            Free cancellation up to 24 hours before check-in
                        </p>
                    </form>
                </div>
                
                <div class="card-footer">
                    <div class="text-center">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt"></i> Secure booking • No hidden fees
                        </small>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6><i class="fas fa-phone"></i> Need Help?</h6>
                </div>
                <div class="card-body">
                    <p class="small mb-2"><strong>Contact Hotel:</strong></p>
                    <p class="small text-muted mb-2">
                        <i class="fas fa-phone"></i> +1 (555) 123-4567
                    </p>
                    <p class="small text-muted mb-3">
                        <i class="fas fa-envelope"></i> info@hotel.com
                    </p>
                    <a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-primary btn-sm btn-block">
                        <i class="fas fa-comments"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var roomPrice = <?php echo $room->price_per_night; ?>;
    
    // Set minimum dates
    var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    
    $('#check_in').attr('min', today.toISOString().split('T')[0]);
    $('#check_out').attr('min', tomorrow.toISOString().split('T')[0]);
    
    // Update minimum checkout date when checkin changes
    $('#check_in').on('change', function() {
        var checkinDate = new Date($(this).val());
        checkinDate.setDate(checkinDate.getDate() + 1);
        $('#check_out').attr('min', checkinDate.toISOString().split('T')[0]);
        calculatePrice();
        checkAvailability();
    });
    
    $('#check_out').on('change', function() {
        calculatePrice();
        checkAvailability();
    });
    
    function calculatePrice() {
        var checkIn = $('#check_in').val();
        var checkOut = $('#check_out').val();
        
        if (checkIn && checkOut) {
            var startDate = new Date(checkIn);
            var endDate = new Date(checkOut);
            var timeDiff = endDate.getTime() - startDate.getTime();
            var nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            if (nights > 0) {
                var subtotal = roomPrice * nights;
                var taxes = subtotal * 0.10;
                var total = subtotal + taxes;
                
                $('#nightsCount').text(nights);
                $('#subtotal').text('$' + subtotal.toFixed(2));
                $('#taxes').text('$' + taxes.toFixed(2));
                $('#totalAmount').text('$' + total.toFixed(2));
                $('#priceCalculator').show();
            } else {
                $('#priceCalculator').hide();
            }
        } else {
            $('#priceCalculator').hide();
        }
    }
    
    function checkAvailability() {
        var checkIn = $('#check_in').val();
        var checkOut = $('#check_out').val();
        var roomId = <?php echo $room->id; ?>;
        
        if (checkIn && checkOut && checkIn < checkOut) {
            $('#availabilityCheck').show();
            $('#availabilityResult').empty();
            $('#bookNowBtn').prop('disabled', true);
            
            $.ajax({
                url: '<?php echo base_url("api/availability"); ?>',
                method: 'POST',
                data: {
                    room_id: roomId,
                    check_in: checkIn,
                    check_out: checkOut
                },
                success: function(response) {
                    $('#availabilityCheck').hide();
                    
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    
                    if (response.available) {
                        $('#availabilityResult').html('<div class="alert alert-success"><i class="fas fa-check-circle"></i> Room is available for selected dates!</div>');
                        $('#bookNowBtn').prop('disabled', false);
                    } else {
                        $('#availabilityResult').html('<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Room is not available for selected dates. Please choose different dates.</div>');
                        $('#bookNowBtn').prop('disabled', true);
                    }
                },
                error: function() {
                    $('#availabilityCheck').hide();
                    $('#availabilityResult').html('<div class="alert alert-info"><i class="fas fa-info-circle"></i> Please proceed to check availability during booking.</div>');
                    $('#bookNowBtn').prop('disabled', false);
                }
            });
        }
    }
    
    // Form validation
    $('#bookingForm').on('submit', function(e) {
        var checkIn = $('#check_in').val();
        var checkOut = $('#check_out').val();
        
        if (!checkIn || !checkOut) {
            e.preventDefault();
            alert('Please select check-in and check-out dates');
            return false;
        }
        
        if (checkIn >= checkOut) {
            e.preventDefault();
            alert('Check-out date must be after check-in date');
            return false;
        }
    });
});
</script>