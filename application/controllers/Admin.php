<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['User_model', 'Room_model', 'Booking_model', 'Hotel_model']);
        $this->load->library(['pagination', 'form_validation']);
        
        // Check if user is logged in and has admin/staff role
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $role = $this->session->userdata('role');
        if ($role !== 'admin' && $role !== 'staff') {
            redirect('home');
        }
    }

    public function index() {
        redirect('admin/dashboard');
    }

    public function dashboard() {
        $data['title'] = 'Admin Dashboard - Hotel Management';
        
        // Get dashboard statistics
        $data['stats'] = array(
            'total_bookings' => $this->Booking_model->count_bookings(),
            'total_rooms' => $this->Room_model->count_rooms(),
            'total_users' => $this->User_model->count_users('customer'),
            'total_hotels' => $this->Hotel_model->count_hotels()
        );
        
        // Get recent bookings
        $data['recent_bookings'] = $this->Booking_model->get_bookings(5, 0);
        
        // Get today's check-ins and check-outs
        $data['todays_checkins'] = $this->Booking_model->get_todays_checkins();
        $data['todays_checkouts'] = $this->Booking_model->get_todays_checkouts();
        
        // Get booking statistics for current month
        $first_day = date('Y-m-01');
        $last_day = date('Y-m-t');
        $data['monthly_stats'] = $this->Booking_model->get_booking_stats($first_day, $last_day);
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/admin_footer');
    }

    public function rooms() {
        $data['title'] = 'Room Management - Admin';
        
        // Pagination
        $config['base_url'] = base_url('admin/rooms');
        $config['total_rows'] = $this->Room_model->count_rooms();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['rooms'] = $this->Room_model->get_rooms($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        // Get hotels and room types for filters
        $data['hotels'] = $this->Hotel_model->get_active_hotels();
        $data['room_types'] = $this->Room_model->get_room_types();
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/rooms', $data);
        $this->load->view('templates/admin_footer');
    }

    public function bookings() {
        $data['title'] = 'Booking Management - Admin';
        
        // Get filters
        $filters = array();
        if ($this->input->get('status')) {
            $filters['status'] = $this->input->get('status');
        }
        if ($this->input->get('payment_status')) {
            $filters['payment_status'] = $this->input->get('payment_status');
        }
        
        // Pagination
        $config['base_url'] = base_url('admin/bookings');
        $config['total_rows'] = $this->Booking_model->count_bookings($filters);
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['bookings'] = $this->Booking_model->get_bookings($config['per_page'], $page, $filters);
        $data['pagination'] = $this->pagination->create_links();
        $data['filters'] = $filters;
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/bookings', $data);
        $this->load->view('templates/admin_footer');
    }

    public function users() {
        $data['title'] = 'User Management - Admin';
        
        // Get role filter
        $role = $this->input->get('role');
        
        // Pagination
        $config['base_url'] = base_url('admin/users');
        $config['total_rows'] = $this->User_model->count_users($role);
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->User_model->get_users($config['per_page'], $page, $role);
        $data['pagination'] = $this->pagination->create_links();
        $data['selected_role'] = $role;
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('templates/admin_footer');
    }

    public function reports() {
        $data['title'] = 'Reports - Admin';
        
        // Date range for reports
        $date_from = $this->input->get('date_from') ?: date('Y-m-01');
        $date_to = $this->input->get('date_to') ?: date('Y-m-t');
        
        // Get booking statistics
        $data['booking_stats'] = $this->Booking_model->get_booking_stats($date_from, $date_to);
        $data['room_stats'] = $this->Room_model->get_room_stats();
        
        // Get upcoming bookings
        $data['upcoming_bookings'] = $this->Booking_model->get_upcoming_bookings(30);
        
        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/reports', $data);
        $this->load->view('templates/admin_footer');
    }

    public function hotels() {
        $data['title'] = 'Hotel Management - Admin';
        
        // Pagination
        $config['base_url'] = base_url('admin/hotels');
        $config['total_rows'] = $this->Hotel_model->count_hotels();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['hotels'] = $this->Hotel_model->get_hotels_with_rooms();
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/hotels', $data);
        $this->load->view('templates/admin_footer');
    }

    // AJAX methods for quick actions
    public function update_booking_status() {
        if ($this->input->is_ajax_request()) {
            $booking_id = $this->input->post('booking_id');
            $status = $this->input->post('status');
            
            if ($this->Booking_model->update_status($booking_id, $status)) {
                echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update status']);
            }
        }
    }

    public function update_room_status() {
        if ($this->input->is_ajax_request()) {
            $room_id = $this->input->post('room_id');
            $status = $this->input->post('status');
            
            if ($this->Room_model->update_status($room_id, $status)) {
                echo json_encode(['success' => true, 'message' => 'Room status updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update room status']);
            }
        }
    }

    public function settings() {
        $data['title'] = 'System Settings - Admin';
        
        if ($this->input->post()) {
            // Handle settings update
            $this->form_validation->set_rules('site_name', 'Site Name', 'required|trim');
            $this->form_validation->set_rules('site_email', 'Site Email', 'required|valid_email');
            
            if ($this->form_validation->run()) {
                // Update settings logic would go here
                $this->session->set_flashdata('success', 'Settings updated successfully');
                redirect('admin/settings');
            }
        }
        
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('templates/admin_footer');
    }
}