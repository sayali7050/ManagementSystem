<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login() {
        // Redirect if already logged in
        if ($this->session->userdata('user_id')) {
            $role = $this->session->userdata('role');
            redirect($role === 'admin' ? 'admin/dashboard' : 'customer/dashboard');
        }

        $data['title'] = 'Login - Hotel Management System';

        if ($this->input->post()) {
            $this->form_validation->set_rules('login', 'Email/Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $login = $this->input->post('login');
                $password = $this->input->post('password');

                $user = $this->User_model->authenticate($login, $password);

                if ($user) {
                    // Set session data
                    $session_data = array(
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'role' => $user->role,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($session_data);

                    // Update last login
                    $this->User_model->update_last_login($user->id);

                    // Redirect based on role
                    if ($user->role === 'admin' || $user->role === 'staff') {
                        redirect('admin/dashboard');
                    } else {
                        redirect('customer/dashboard');
                    }
                } else {
                    $data['error'] = 'Invalid email/username or password.';
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/footer');
    }

    public function register() {
        // Redirect if already logged in
        if ($this->session->userdata('user_id')) {
            redirect('customer/dashboard');
        }

        $data['title'] = 'Register - Hotel Management System';

        if ($this->input->post()) {
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]|is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $user_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'password' => $this->input->post('password'),
                    'role' => 'customer'
                );

                if ($this->User_model->create_user($user_data)) {
                    $data['success'] = 'Registration successful! You can now login.';
                } else {
                    $data['error'] = 'Registration failed. Please try again.';
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('auth/register', $data);
        $this->load->view('templates/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }

    public function forgot_password() {
        $data['title'] = 'Forgot Password - Hotel Management System';

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $user = $this->User_model->get_user_by_email($email);

                if ($user) {
                    // Generate reset token and send email
                    // For now, just show success message
                    $data['success'] = 'Password reset instructions have been sent to your email.';
                } else {
                    $data['error'] = 'Email address not found.';
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('auth/forgot_password', $data);
        $this->load->view('templates/footer');
    }

    public function check_username() {
        $username = $this->input->post('username');
        $exists = $this->User_model->username_exists($username);
        echo json_encode(['exists' => $exists]);
    }

    public function check_email() {
        $email = $this->input->post('email');
        $exists = $this->User_model->email_exists($email);
        echo json_encode(['exists' => $exists]);
    }

    // Check if user is logged in (helper method)
    private function is_logged_in() {
        return $this->session->userdata('logged_in') === TRUE;
    }

    // Check if user has admin role
    private function is_admin() {
        return $this->session->userdata('role') === 'admin';
    }

    // Check if user has staff role
    private function is_staff() {
        $role = $this->session->userdata('role');
        return $role === 'admin' || $role === 'staff';
    }
}