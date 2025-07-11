<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['User_model', 'Booking_model']);
        $this->load->library(['form_validation']);
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        // Check if user is customer
        $role = $this->session->userdata('role');
        if ($role !== 'customer') {
            redirect('home');
        }
    }

    public function index() {
        redirect('customer/dashboard');
    }

    public function dashboard() {
        $data['title'] = 'Customer Dashboard';
        $user_id = $this->session->userdata('user_id');
        
        // Get customer statistics
        $data['stats'] = array(
            'total_bookings' => $this->Booking_model->count_user_bookings($user_id),
            'upcoming_bookings' => $this->Booking_model->count_upcoming_bookings($user_id),
            'completed_bookings' => $this->Booking_model->count_completed_bookings($user_id),
            'cancelled_bookings' => $this->Booking_model->count_cancelled_bookings($user_id)
        );
        
        // Get recent bookings
        $data['recent_bookings'] = $this->Booking_model->get_user_bookings($user_id, 5, 0);
        
        // Get upcoming bookings
        $data['upcoming_bookings'] = $this->Booking_model->get_upcoming_user_bookings($user_id, 3);
        
        $this->load->view('templates/header', $data);
        $this->load->view('customer/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function profile() {
        $data['title'] = 'My Profile';
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post()) {
            // Handle profile update
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
            
            if ($this->form_validation->run()) {
                $profile_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address')
                );
                
                if ($this->User_model->update_user($user_id, $profile_data)) {
                    // Update session data
                    $this->session->set_userdata('first_name', $profile_data['first_name']);
                    $this->session->set_userdata('last_name', $profile_data['last_name']);
                    
                    $this->session->set_flashdata('success', 'Profile updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile');
                }
                
                redirect('customer/profile');
            }
        }
        
        $data['user'] = $this->User_model->get_user($user_id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('customer/profile', $data);
        $this->load->view('templates/footer');
    }

    public function change_password() {
        $data['title'] = 'Change Password';
        $user_id = $this->session->userdata('user_id');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
            
            if ($this->form_validation->run()) {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');
                
                // Verify current password
                $user = $this->User_model->get_user($user_id);
                if (password_verify($current_password, $user['password'])) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    
                    if ($this->User_model->update_password($user_id, $hashed_password)) {
                        $this->session->set_flashdata('success', 'Password changed successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Failed to change password');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Current password is incorrect');
                }
                
                redirect('customer/change_password');
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('customer/change_password', $data);
        $this->load->view('templates/footer');
    }
}