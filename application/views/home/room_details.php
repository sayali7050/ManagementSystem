<!-- LuxuryHotel-inspired Room Details Page -->
<div class="bg-primary bg-gradient py-5 mb-4 text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-2"><?php echo $room->room_type_name; ?></h1>
                <p class="lead mb-0"><i class="fas fa-hotel me-2"></i><?php echo $room->hotel_name; ?> &mdash; Room <?php echo $room->room_number; ?></p>
                <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i><?php echo $room->address; ?>, <?php echo $room->city; ?></p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <?php if ($room->star_rating > 0): ?>
                    <div class="mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i <= $room->star_rating ? 'text-warning' : 'text-white-50'; ?>"></i>
                        <?php endfor; ?>
                        <span class="ms-2"><?php echo $room->star_rating; ?>/5</span>
                    </div>
                <?php endif; ?>
                <span class="badge bg-light text-primary fs-6">Floor <?php echo $room->floor; ?></span>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        <!-- Room Images (LuxuryHotel style placeholder) -->
        <div class="col-lg-7">
            <div class="mb-4">
                <?php if (!empty($room->image_url)): ?>
                    <img src="<?php echo htmlspecialchars($room->image_url); ?>" alt="Room Image" class="img-fluid rounded-4 shadow-sm w-100" style="min-height:320px; object-fit:cover;">
                <?php else: ?>
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Room Image" class="img-fluid rounded-4 shadow-sm w-100" style="min-height:320px; object-fit:cover;">
                <?php endif; ?>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title mb-3">About this Room</h3>
                    <p class="mb-2"><?php echo $room->description ?: 'Experience comfort and luxury in our well-appointed ' . $room->room_type_name . '.'; ?></p>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-3"><i class="fas fa-users text-primary"></i> Up to <?php echo $room->max_occupancy; ?> guests</li>
                        <li class="list-inline-item me-3"><i class="fas fa-bed text-primary"></i> <?php echo $room->room_type_name; ?></li>
                        <li class="list-inline-item"><i class="fas fa-door-open text-primary"></i> Room <?php echo $room->room_number; ?></li>
                    </ul>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fas fa-concierge-bell me-2 text-primary"></i>Amenities</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-wifi text-success me-2"></i>Free Wi-Fi</li>
                                <li><i class="fas fa-tv text-success me-2"></i>Flat-screen TV</li>
                                <li><i class="fas fa-snowflake text-success me-2"></i>Air Conditioning</li>
                                <li><i class="fas fa-bath text-success me-2"></i>Private Bathroom</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-coffee text-success me-2"></i>Coffee/Tea Maker</li>
                                <li><i class="fas fa-phone text-success me-2"></i>Room Service</li>
                                <li><i class="fas fa-tshirt text-success me-2"></i>Daily Housekeeping</li>
                                <li><i class="fas fa-lock text-success me-2"></i>Safe Deposit Box</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Similar Rooms -->
            <?php if (isset($similar_rooms) && !empty($similar_rooms)): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-bed me-2"></i>Similar Rooms</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <?php foreach ($similar_rooms as $similar_room): ?>
                                <?php if ($similar_room->id != $room->id): ?>
                                    <div class="col-md-6">
                                        <div class="card h-100 border-0 bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo $similar_room->room_type_name; ?></h6>
                                                <p class="text-muted small mb-2">Room <?php echo $similar_room->room_number; ?></p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-primary fw-bold">
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
        <div class="col-lg-5">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Book This Room</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('booking'); ?>" method="GET" id="bookingForm">
                        <input type="hidden" name="room_id" value="<?php echo $room->id; ?>">
                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required>
                        </div>
                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Guests</label>
                            <input type="number" class="form-control" id="guests" name="guests" min="1" max="<?php echo $room->max_occupancy; ?>" value="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2"><i class="fas fa-check-circle me-2"></i>Book Now</button>
                    </form>
                    <div class="mt-3">
                        <span class="h4 text-primary">$<?php echo number_format($room->price_per_night, 2); ?></span>
                        <small class="text-muted">/night</small>
                    </div>
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