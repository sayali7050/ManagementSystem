<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Room_model', 'Hotel_model', 'Booking_model']);
        $this->load->library('pagination');
    }

    public function index() {
        $data['title'] = 'Hotel Management System - Find Your Perfect Stay';
        
        // Get featured hotels
        $data['hotels'] = $this->Hotel_model->get_active_hotels();
        
        // Get available room types
        $data['room_types'] = $this->Room_model->get_room_types();
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function search() {
        // Check if this is a direct access without any parameters
        if (empty($this->input->get())) {
            redirect(base_url());
            return;
        }
        
        // Get search parameters with defaults
        $check_in = $this->input->get('check_in') ?: date('Y-m-d');
        $check_out = $this->input->get('check_out') ?: date('Y-m-d', strtotime('+1 day'));
        $guests = $this->input->get('guests') ?: 2;
        $hotel_id = $this->input->get('hotel_id');
        $room_type_id = $this->input->get('room_type_id');
        $min_price = $this->input->get('min_price');
        $max_price = $this->input->get('max_price');
        // New sidebar filters
        $price_range = $this->input->get('price_range');
        $capacity = $this->input->get('capacity');
        $features = $this->input->get('features'); // array

        // Map price_range dropdown to min/max price
        if ($price_range == '1') { $min_price = 0; $max_price = 100; }
        if ($price_range == '2') { $min_price = 100; $max_price = 200; }
        if ($price_range == '3') { $min_price = 200; $max_price = 300; }
        if ($price_range == '4') { $min_price = 300; $max_price = null; }

        $data['title'] = 'Search Results - Available Rooms';
        $data['search_params'] = $this->input->get();

        // Debug: Log the search parameters
        error_log('Search params: ' . print_r($this->input->get(), true));

        // Validate dates
        if (strtotime($check_in) >= strtotime($check_out)) {
            $data['error'] = 'Check-out date must be after check-in date.';
            $data['rooms'] = [];
        } else {
            // Build filters
            $filters = [];
            if ($hotel_id) $filters['hotel_id'] = $hotel_id;
            if ($room_type_id) $filters['room_type_id'] = $room_type_id;
            if ($min_price) $filters['min_price'] = $min_price;
            if ($max_price) $filters['max_price'] = $max_price;
            if ($capacity) $filters['capacity'] = $capacity;
            if ($features && is_array($features)) $filters['features'] = $features;

            // Debug: Log the filters
            error_log('Filters: ' . print_r($filters, true));

            // Search available rooms
            $data['rooms'] = $this->Room_model->get_available_rooms($check_in, $check_out, $guests, $filters);
            $data['total_nights'] = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
            
            // Debug: Log the results
            error_log('Found ' . count($data['rooms']) . ' rooms');
        }

        // Get filter options
        $data['hotels'] = $this->Hotel_model->get_active_hotels();
        $data['room_types'] = $this->Room_model->get_room_types();

        $this->load->view('templates/header', $data);
        $this->load->view('home/search_results', $data);
        $this->load->view('templates/footer');
    }

    public function room_details($room_id) {
        $room = $this->Room_model->get_room($room_id);
        
        if (!$room) {
            show_404();
        }

        $data['title'] = $room->room_type_name . ' - ' . $room->hotel_name;
        $data['room'] = $room;
        
        // Get similar rooms
        $data['similar_rooms'] = $this->Room_model->get_rooms(4, 0, [
            'hotel_id' => $room->hotel_id,
            'status' => 'available'
        ]);

        $this->load->view('templates/header', $data);
        $this->load->view('home/room_details', $data);
        $this->load->view('templates/footer');
    }

    public function about() {
        $data['title'] = 'About Us - Hotel Management System';
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/about', $data);
        $this->load->view('templates/footer');
    }

    public function contact() {
        $data['title'] = 'Contact Us - Hotel Management System';
        
        if ($this->input->post()) {
            // Handle contact form submission
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
            $this->form_validation->set_rules('message', 'Message', 'required|trim');

            if ($this->form_validation->run()) {
                // Process contact form (save to database or send email)
                $data['success'] = 'Thank you for your message. We will get back to you soon.';
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/contact', $data);
        $this->load->view('templates/footer');
    }

    public function booking_lookup() {
        $data['title'] = 'Booking Lookup - Find Your Reservation';
        
        if ($this->input->post()) {
            $reference = $this->input->post('booking_reference');
            $email = $this->input->post('email');
            
            if ($reference && $email) {
                $booking = $this->Booking_model->get_booking_by_reference($reference);
                
                if ($booking && $booking->email === $email) {
                    $data['booking'] = $booking;
                } else {
                    $data['error'] = 'Booking not found or email does not match.';
                }
            } else {
                $data['error'] = 'Please enter both booking reference and email.';
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/booking_lookup', $data);
        $this->load->view('templates/footer');
    }

    public function test_filters() {
        // Test method to verify filters are working
        echo "<h2>Testing Filters</h2>";
        
        // Test basic room query
        $rooms = $this->Room_model->get_rooms(10, 0, []);
        echo "<h3>All Rooms (" . count($rooms) . " found):</h3>";
        foreach ($rooms as $room) {
            echo "- {$room->hotel_name}: {$room->room_type_name} - \${$room->price_per_night}<br>";
        }
        
        // Test available rooms query
        $check_in = date('Y-m-d');
        $check_out = date('Y-m-d', strtotime('+1 day'));
        $available_rooms = $this->Room_model->get_available_rooms($check_in, $check_out, 2, []);
        echo "<h3>Available Rooms for {$check_in} to {$check_out} (" . count($available_rooms) . " found):</h3>";
        foreach ($available_rooms as $room) {
            echo "- {$room->hotel_name}: {$room->room_type_name} - \${$room->price_per_night} (max: {$room->max_occupancy})<br>";
        }
        
        // Test price filter
        $price_filtered = $this->Room_model->get_available_rooms($check_in, $check_out, 2, ['min_price' => 100, 'max_price' => 200]);
        echo "<h3>Price Filtered (\$100-\$200) (" . count($price_filtered) . " found):</h3>";
        foreach ($price_filtered as $room) {
            echo "- {$room->hotel_name}: {$room->room_type_name} - \${$room->price_per_night}<br>";
        }
        
        // Test capacity filter
        $capacity_filtered = $this->Room_model->get_available_rooms($check_in, $check_out, 2, ['capacity' => '3']);
        echo "<h3>Capacity Filtered (3+ guests) (" . count($capacity_filtered) . " found):</h3>";
        foreach ($capacity_filtered as $room) {
            echo "- {$room->hotel_name}: {$room->room_type_name} - \${$room->price_per_night} (max: {$room->max_occupancy})<br>";
        }
        
        // Test amenities filter
        $amenities_filtered = $this->Room_model->get_available_rooms($check_in, $check_out, 2, ['features' => ['wifi']]);
        echo "<h3>Amenities Filtered (Wi-Fi) (" . count($amenities_filtered) . " found):</h3>";
        foreach ($amenities_filtered as $room) {
            echo "- {$room->hotel_name}: {$room->room_type_name} - \${$room->price_per_night} (amenities: {$room->amenities})<br>";
        }
    }

    public function test_db() {
        echo "<h2>Database Connection Test</h2>";
        
        // Test database connection
        if ($this->db->simple_query('SELECT 1')) {
            echo "<p style='color:green'>✓ Database connection successful</p>";
        } else {
            echo "<p style='color:red'>✗ Database connection failed</p>";
            return;
        }
        
        // Test if tables exist
        $tables = ['hotels', 'room_types', 'rooms', 'bookings'];
        foreach ($tables as $table) {
            $result = $this->db->query("SHOW TABLES LIKE '$table'");
            if ($result->num_rows() > 0) {
                echo "<p style='color:green'>✓ Table '$table' exists</p>";
            } else {
                echo "<p style='color:red'>✗ Table '$table' does not exist</p>";
            }
        }
        
        // Test hotel model
        try {
            $hotels = $this->Hotel_model->get_active_hotels();
            echo "<p style='color:green'>✓ Hotel model working - Found " . count($hotels) . " hotels</p>";
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Hotel model error: " . $e->getMessage() . "</p>";
        }
        
        // Test room types model
        try {
            $room_types = $this->Room_model->get_room_types();
            echo "<p style='color:green'>✓ Room types model working - Found " . count($room_types) . " room types</p>";
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Room types model error: " . $e->getMessage() . "</p>";
        }
        
        // Test rooms model
        try {
            $rooms = $this->Room_model->get_rooms(5, 0, []);
            echo "<p style='color:green'>✓ Rooms model working - Found " . count($rooms) . " rooms</p>";
        } catch (Exception $e) {
            echo "<p style='color:red'>✗ Rooms model error: " . $e->getMessage() . "</p>";
        }
    }

    public function rooms() {
        // Get filter parameters
        $hotel_id = $this->input->get('hotel_id');
        $room_type_id = $this->input->get('room_type_id');
        $min_price = $this->input->get('min_price');
        $max_price = $this->input->get('max_price');
        $price_range = $this->input->get('price_range');
        $capacity = $this->input->get('capacity');
        $features = $this->input->get('features'); // array

        // Map price_range dropdown to min/max price
        if ($price_range == '1') { $min_price = 0; $max_price = 100; }
        if ($price_range == '2') { $min_price = 100; $max_price = 200; }
        if ($price_range == '3') { $min_price = 200; $max_price = 300; }
        if ($price_range == '4') { $min_price = 300; $max_price = null; }

        $data['title'] = 'All Rooms - Browse Our Accommodations';
        $data['search_params'] = $this->input->get();

        // Build filters
        $filters = [];
        if ($hotel_id) $filters['hotel_id'] = $hotel_id;
        if ($room_type_id) $filters['room_type_id'] = $room_type_id;
        if ($min_price) $filters['min_price'] = $min_price;
        if ($max_price) $filters['max_price'] = $max_price;
        if ($capacity) $filters['capacity'] = $capacity;
        if ($features && is_array($features)) $filters['features'] = $features;

        // Get all rooms with filters
        $data['rooms'] = $this->Room_model->get_rooms_with_filters(50, 0, $filters);

        // Get filter options
        $data['hotels'] = $this->Hotel_model->get_active_hotels();
        $data['room_types'] = $this->Room_model->get_room_types();

        $this->load->view('templates/header', $data);
        $this->load->view('home/rooms', $data);
        $this->load->view('templates/footer');
    }
}

