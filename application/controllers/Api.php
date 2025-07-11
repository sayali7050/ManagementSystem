<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['User_model', 'Room_model', 'Booking_model']);
        
        // Set JSON header
        $this->output->set_content_type('application/json');
    }

    public function check_availability() {
        $room_id = $this->input->post('room_id');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');

        if ($room_id && $check_in && $check_out) {
            $available = $this->Room_model->check_availability($room_id, $check_in, $check_out);
            echo json_encode(['available' => $available]);
        } else {
            echo json_encode(['error' => 'Missing parameters']);
        }
    }

    public function check_username() {
        $username = $this->input->post('username');
        $user_id = $this->input->post('user_id'); // For edit profile
        
        if ($username) {
            $exists = $this->User_model->check_username_exists($username, $user_id);
            echo json_encode(['available' => !$exists]);
        } else {
            echo json_encode(['error' => 'Username required']);
        }
    }

    public function check_email() {
        $email = $this->input->post('email');
        $user_id = $this->input->post('user_id'); // For edit profile
        
        if ($email) {
            $exists = $this->User_model->check_email_exists($email, $user_id);
            echo json_encode(['available' => !$exists]);
        } else {
            echo json_encode(['error' => 'Email required']);
        }
    }

    public function calculate_price() {
        $room_id = $this->input->post('room_id');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');

        if ($room_id && $check_in && $check_out) {
            $room = $this->Room_model->get_room_by_id($room_id);
            
            if ($room) {
                $check_in_date = new DateTime($check_in);
                $check_out_date = new DateTime($check_out);
                $days = $check_out_date->diff($check_in_date)->days;
                
                if ($days > 0) {
                    $subtotal = $room['price'] * $days;
                    $tax = $subtotal * 0.10; // 10% tax
                    $total = $subtotal + $tax;
                    
                    echo json_encode([
                        'success' => true,
                        'days' => $days,
                        'price_per_night' => $room['price'],
                        'subtotal' => $subtotal,
                        'tax' => $tax,
                        'total' => $total
                    ]);
                } else {
                    echo json_encode(['error' => 'Invalid date range']);
                }
            } else {
                echo json_encode(['error' => 'Room not found']);
            }
        } else {
            echo json_encode(['error' => 'Missing parameters']);
        }
    }

    public function search_rooms() {
        $location = $this->input->post('location');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');
        $guests = $this->input->post('guests');
        $price_range = $this->input->post('price_range');
        
        $filters = array(
            'location' => $location,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'guests' => $guests,
            'price_range' => $price_range
        );
        
        $rooms = $this->Room_model->search_available_rooms($filters);
        
        echo json_encode([
            'success' => true,
            'rooms' => $rooms,
            'total' => count($rooms)
        ]);
    }

    public function get_room_types() {
        $hotel_id = $this->input->post('hotel_id');
        $room_types = $this->Room_model->get_room_types($hotel_id);
        
        echo json_encode([
            'success' => true,
            'room_types' => $room_types
        ]);
    }

    public function contact_form() {
        $this->load->library('form_validation');
        $this->load->library('email');
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        
        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            
            // Send email
            $this->email->from($email, $name);
            $this->email->to('admin@hotel.com');
            $this->email->subject('Contact Form: ' . $subject);
            $this->email->message("From: " . $name . " (" . $email . ")\n\n" . $message);
            
            if ($this->email->send()) {
                echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send message']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
        }
    }

    public function get_hotel_details() {
        $hotel_id = $this->input->post('hotel_id');
        
        if ($hotel_id) {
            $hotel = $this->Hotel_model->get_hotel_by_id($hotel_id);
            
            if ($hotel) {
                echo json_encode(['success' => true, 'hotel' => $hotel]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Hotel not found']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Hotel ID required']);
        }
    }

    public function get_booking_details() {
        $booking_reference = $this->input->post('booking_reference');
        $email = $this->input->post('email');
        
        if ($booking_reference && $email) {
            $booking = $this->Booking_model->get_booking_by_reference($booking_reference, $email);
            
            if ($booking) {
                echo json_encode(['success' => true, 'booking' => $booking]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Booking not found']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Booking reference and email required']);
        }
    }

    public function update_booking_status() {
        // Check if user is admin/staff
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }
        
        $role = $this->session->userdata('role');
        if ($role !== 'admin' && $role !== 'staff') {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }
        
        $booking_id = $this->input->post('booking_id');
        $status = $this->input->post('status');
        
        if ($booking_id && $status) {
            if ($this->Booking_model->update_status($booking_id, $status)) {
                echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update status']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
        }
    }

    public function get_available_rooms() {
        $hotel_id = $this->input->post('hotel_id');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');
        $room_type = $this->input->post('room_type');
        
        $filters = array(
            'hotel_id' => $hotel_id,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'room_type' => $room_type
        );
        
        $rooms = $this->Room_model->get_available_rooms($filters);
        
        echo json_encode([
            'success' => true,
            'rooms' => $rooms
        ]);
    }

    public function newsletter_signup() {
        $email = $this->input->post('email');
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Here you would typically save to newsletter table
            // For now, just return success
            echo json_encode(['success' => true, 'message' => 'Thank you for subscribing to our newsletter!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
        }
    }
}