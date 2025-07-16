<!-- LuxuryHotel-inspired Make Booking Page -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Make a New Booking</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo base_url('booking/book'); ?>">
                        <div class="mb-3">
                            <label for="hotel_id" class="form-label">Hotel</label>
                            <select class="form-select" id="hotel_id" name="hotel_id" required>
                                <option value="">Select Hotel</option>
                                <?php if (!empty($hotels)) foreach ($hotels as $hotel): ?>
                                    <option value="<?php echo $hotel->id; ?>"><?php echo htmlspecialchars($hotel->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Room</label>
                            <select class="form-select" id="room_id" name="room_id" required>
                                <option value="">Select Room</option>
                                <?php if (!empty($rooms)) foreach ($rooms as $room): ?>
                                    <option value="<?php echo $room->id; ?>" data-hotel="<?php echo $room->hotel_id; ?>">
                                        <?php echo htmlspecialchars($room->room_type_name . ' - Room ' . $room->room_number . ' (' . $room->max_occupancy . ' guests)'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="check_in" class="form-label">Check-in Date</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" required>
                            </div>
                            <div class="col-md-6">
                                <label for="check_out" class="form-label">Check-out Date</label>
                                <input type="date" class="form-control" id="check_out" name="check_out" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Guests</label>
                            <input type="number" class="form-control" id="guests" name="guests" min="1" value="1" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#hotel_id').on('change', function() {
        var hotelId = $(this).val();
        $('#room_id').html('<option value="">Loading...</option>');
        if (hotelId) {
            $.ajax({
                url: '<?php echo base_url('customer/get_rooms_by_hotel'); ?>',
                type: 'POST',
                data: { hotel_id: hotelId },
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select Room</option>';
                    if (response.rooms && response.rooms.length > 0) {
                        response.rooms.forEach(function(room) {
                            options += '<option value="' + room.id + '">' +
                                room.room_type_name + ' - Room ' + room.room_number + ' (' + room.max_occupancy + ' guests)' +
                                '</option>';
                        });
                    } else {
                        options += '<option value="">No rooms available</option>';
                    }
                    $('#room_id').html(options);
                },
                error: function() {
                    $('#room_id').html('<option value="">Error loading rooms</option>');
                }
            });
        } else {
            $('#room_id').html('<option value="">Select Room</option>');
        }
    });
});
</script>
