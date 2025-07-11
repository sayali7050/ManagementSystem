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
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }

    public function search() {
        // Get search parameters
        $check_in = $this->input->get('check_in');
        $check_out = $this->input->get('check_out');
        $guests = $this->input->get('guests', 1);
        $hotel_id = $this->input->get('hotel_id');
        $room_type_id = $this->input->get('room_type_id');
        $min_price = $this->input->get('min_price');
        $max_price = $this->input->get('max_price');

        $data['title'] = 'Search Results - Available Rooms';
        $data['search_params'] = $this->input->get();

        if ($check_in && $check_out) {
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

                // Search available rooms
                $data['rooms'] = $this->Room_model->get_available_rooms($check_in, $check_out, $guests, $filters);
                $data['total_nights'] = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
            }
        } else {
            $data['error'] = 'Please select check-in and check-out dates.';
            $data['rooms'] = [];
        }

        // Get filter options
        $data['hotels'] = $this->Hotel_model->get_active_hotels();
        $data['room_types'] = $this->Room_model->get_room_types();

        $this->load->view('templates/header', $data);
        $this->load->view('search_results', $data);
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
        $this->load->view('room_details', $data);
        $this->load->view('templates/footer');
    }

    public function about() {
        $data['title'] = 'About Us - Hotel Management System';
        
        $this->load->view('templates/header', $data);
        $this->load->view('about', $data);
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
        $this->load->view('contact', $data);
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
        $this->load->view('booking_lookup', $data);
        $this->load->view('templates/footer');
    }
}