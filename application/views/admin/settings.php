<!-- LuxuryHotel Admin - Settings -->
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Site Settings</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="siteName" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="siteName" placeholder="LuxuryHotel Management System" value="LuxuryHotel Management System">
                    </div>
                    <div class="mb-3">
                        <label for="siteEmail" class="form-label">Contact Email</label>
                        <input type="email" class="form-control" id="siteEmail" placeholder="admin@luxuryhotel.com" value="admin@luxuryhotel.com">
                    </div>
                    <div class="mb-3">
                        <label for="currency" class="form-label">Default Currency</label>
                        <select class="form-select" id="currency">
                            <option selected>USD ($)</option>
                            <option>EUR (€)</option>
                            <option>GBP (£)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="timezone" class="form-label">Timezone</label>
                        <select class="form-select" id="timezone">
                            <option selected>America/New_York</option>
                            <option>Europe/London</option>
                            <option>Asia/Dubai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bookingPolicy" class="form-label">Booking Policy</label>
                        <textarea class="form-control" id="bookingPolicy" rows="3" placeholder="Enter booking policy here...">Bookings must be made at least 24 hours in advance. Cancellations allowed up to 24 hours before check-in.</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 