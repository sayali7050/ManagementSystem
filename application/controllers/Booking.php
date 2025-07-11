<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Booking_model', 'Room_model', 'User_model']);
        $this->load->library(['form_validation', 'email']);
    }

    public function book() {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please login to make a booking');
            redirect('login');
        }

        $room_id = $this->input->post('room_id');
        $hotel_id = $this->input->post('hotel_id');
        $check_in = $this->input->post('check_in');
        $check_out = $this->input->post('check_out');
        $guests = $this->input->post('guests');

        // Validation
        $this->form_validation->set_rules('room_id', 'Room', 'required|integer');
        $this->form_validation->set_rules('hotel_id', 'Hotel', 'required|integer');
        $this->form_validation->set_rules('check_in', 'Check-in Date', 'required');
        $this->form_validation->set_rules('check_out', 'Check-out Date', 'required');
        $this->form_validation->set_rules('guests', 'Number of Guests', 'required|integer|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Check room availability
        if (!$this->Room_model->check_availability($room_id, $check_in, $check_out)) {
            $this->session->set_flashdata('error', 'Room is not available for selected dates');
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Get room and calculate price
        $room = $this->Room_model->get_room_by_id($room_id);
        if (!$room) {
            $this->session->set_flashdata('error', 'Room not found');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $days = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
        $total_amount = $room['price'] * $days;
        $tax_amount = $total_amount * 0.10; // 10% tax
        $final_amount = $total_amount + $tax_amount;

        // Create booking data
        $booking_data = array(
            'user_id' => $this->session->userdata('user_id'),
            'hotel_id' => $hotel_id,
            'room_id' => $room_id,
            'check_in_date' => $check_in,
            'check_out_date' => $check_out,
            'guests' => $guests,
            'total_amount' => $final_amount,
            'tax_amount' => $tax_amount,
            'status' => 'confirmed',
            'payment_status' => 'pending'
        );

        $booking_id = $this->Booking_model->create_booking($booking_data);

        if ($booking_id) {
            // Send confirmation email
            $this->send_booking_confirmation($booking_id);
            
            $this->session->set_flashdata('success', 'Booking confirmed successfully! Your booking reference is: ' . $this->Booking_model->get_booking_reference($booking_id));
            redirect('booking/confirmation/' . $booking_id);
        } else {
            $this->session->set_flashdata('error', 'Failed to create booking. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function confirmation($booking_id) {
        $user_id = $this->session->userdata('user_id');
        $booking = $this->Booking_model->get_booking_by_id($booking_id, $user_id);
        
        if (!$booking) {
            $this->session->set_flashdata('error', 'Booking not found');
            redirect('home');
        }

        $data['title'] = 'Booking Confirmation';
        $data['booking'] = $booking;

        $this->load->view('templates/header', $data);
        $this->load->view('booking/confirmation', $data);
        $this->load->view('templates/footer');
    }

    public function lookup() {
        $data['title'] = 'Booking Lookup';
        
        if ($this->input->post()) {
            $reference = $this->input->post('reference');
            $email = $this->input->post('email');
            
            $this->form_validation->set_rules('reference', 'Booking Reference', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            if ($this->form_validation->run()) {
                $booking = $this->Booking_model->get_booking_by_reference($reference, $email);
                
                if ($booking) {
                    $data['booking'] = $booking;
                } else {
                    $data['error'] = 'Booking not found. Please check your reference number and email.';
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('booking_lookup', $data);
        $this->load->view('templates/footer');
    }

    public function my_bookings() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $data['title'] = 'My Bookings';
        $user_id = $this->session->userdata('user_id');
        
        // Pagination
        $config['base_url'] = base_url('booking/my_bookings');
        $config['total_rows'] = $this->Booking_model->count_user_bookings($user_id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['bookings'] = $this->Booking_model->get_user_bookings($user_id, $config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('booking/my_bookings', $data);
        $this->load->view('templates/footer');
    }

    public function cancel($booking_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $booking = $this->Booking_model->get_booking_by_id($booking_id, $user_id);
        
        if (!$booking) {
            $this->session->set_flashdata('error', 'Booking not found');
            redirect('booking/my_bookings');
        }

        // Check if booking can be cancelled (at least 24 hours before check-in)
        $check_in = strtotime($booking['check_in_date']);
        $now = time();
        $hours_until_checkin = ($check_in - $now) / 3600;

        if ($hours_until_checkin < 24) {
            $this->session->set_flashdata('error', 'Bookings can only be cancelled at least 24 hours before check-in');
            redirect('booking/my_bookings');
        }

        if ($this->Booking_model->cancel_booking($booking_id)) {
            // Send cancellation email
            $this->send_cancellation_email($booking);
            
            $this->session->set_flashdata('success', 'Booking cancelled successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to cancel booking');
        }

        redirect('booking/my_bookings');
    }

    public function invoice($booking_id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $booking = $this->Booking_model->get_booking_by_id($booking_id, $user_id);
        
        if (!$booking) {
            $this->session->set_flashdata('error', 'Booking not found');
            redirect('booking/my_bookings');
        }

        $data['title'] = 'Invoice - ' . $booking['booking_reference'];
        $data['booking'] = $booking;

        $this->load->view('booking/invoice', $data);
    }

    private function send_booking_confirmation($booking_id) {
        $booking = $this->Booking_model->get_booking_by_id($booking_id);
        
        if ($booking) {
            $this->email->from('noreply@hotel.com', 'Hotel Management System');
            $this->email->to($booking['user_email']);
            $this->email->subject('Booking Confirmation - ' . $booking['booking_reference']);
            
            $message = "Dear " . $booking['user_name'] . ",\n\n";
            $message .= "Your booking has been confirmed!\n\n";
            $message .= "Booking Details:\n";
            $message .= "Reference: " . $booking['booking_reference'] . "\n";
            $message .= "Hotel: " . $booking['hotel_name'] . "\n";
            $message .= "Room: " . $booking['room_number'] . " (" . $booking['room_type'] . ")\n";
            $message .= "Check-in: " . date('M j, Y', strtotime($booking['check_in_date'])) . "\n";
            $message .= "Check-out: " . date('M j, Y', strtotime($booking['check_out_date'])) . "\n";
            $message .= "Guests: " . $booking['guests'] . "\n";
            $message .= "Total Amount: $" . number_format($booking['total_amount'], 2) . "\n\n";
            $message .= "Thank you for choosing us!\n\n";
            $message .= "Best regards,\nHotel Management Team";
            
            $this->email->message($message);
            $this->email->send();
        }
    }

    private function send_cancellation_email($booking) {
        $this->email->from('noreply@hotel.com', 'Hotel Management System');
        $this->email->to($booking['user_email']);
        $this->email->subject('Booking Cancellation - ' . $booking['booking_reference']);
        
        $message = "Dear " . $booking['user_name'] . ",\n\n";
        $message .= "Your booking has been cancelled as requested.\n\n";
        $message .= "Cancelled Booking Details:\n";
        $message .= "Reference: " . $booking['booking_reference'] . "\n";
        $message .= "Hotel: " . $booking['hotel_name'] . "\n";
        $message .= "Room: " . $booking['room_number'] . " (" . $booking['room_type'] . ")\n";
        $message .= "Check-in: " . date('M j, Y', strtotime($booking['check_in_date'])) . "\n";
        $message .= "Check-out: " . date('M j, Y', strtotime($booking['check_out_date'])) . "\n\n";
        $message .= "If you have any questions, please contact us.\n\n";
        $message .= "Best regards,\nHotel Management Team";
        
        $this->email->message($message);
        $this->email->send();
    }
}