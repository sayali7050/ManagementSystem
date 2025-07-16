<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Create new user
    public function create_user($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('users', $data);
    }

    // Get user by ID
    public function get_user($id) {
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    // Get user by email
    public function get_user_by_email($email) {
        $this->db->from('users');
        $this->db->where('email', $email);
        return $this->db->get()->row();
    }

    // Get user by username
    public function get_user_by_username($username) {
        $this->db->from('users');
        $this->db->where('username', $username);
        return $this->db->get()->row();
    }

    // Login authentication
    public function authenticate($login, $password) {
        // Try login with email or username
        $this->db->from('users');
        $this->db->where('(email = "' . $login . '" OR username = "' . $login . '")');
        $this->db->where('status', 'active');
        $user = $this->db->get()->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    // Update user
    public function update_user($id, $data) {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update('users', $data);
    }

    // Get all users with pagination
    public function get_users($limit = 10, $offset = 0, $role = null) {
        $this->db->from('users');
        if ($role) {
            $this->db->where('role', $role);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->limit($limit, $offset)->get()->result();
    }

    // Count users
    public function count_users($role = null) {
        $this->db->from('users');
        if ($role) {
            $this->db->where('role', $role);
        }
        return $this->db->count_all_results();
    }

    // Delete user
    public function delete_user($id) {
        return $this->db->where('id', $id)->delete('users');
    }

    // Check if email exists
    public function email_exists($email, $exclude_id = null) {
        $this->db->from('users');
        $this->db->where('email', $email);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results() > 0;
    }

    // Check if username exists
    public function username_exists($username, $exclude_id = null) {
        $this->db->from('users');
        $this->db->where('username', $username);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results() > 0;
    }

    // Update last login
    public function update_last_login($id) {
        $data = array('last_login' => date('Y-m-d H:i:s'));
        return $this->db->where('id', $id)->update('users', $data);
    }

    // Get user's bookings
    public function get_user_bookings($user_id, $limit = 10, $offset = 0) {
        $this->db->select('b.*, r.room_number, r.price_per_night, rt.name as room_type, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.user_id', $user_id);
        $this->db->order_by('b.created_at', 'DESC');
        return $this->db->limit($limit, $offset)->get()->result();
    }

    // Change user status
    public function change_status($id, $status) {
        $data = array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $id)->update('users', $data);
    }

    // Additional methods for API compatibility
    public function check_username_exists($username, $exclude_id = null) {
        return $this->username_exists($username, $exclude_id);
    }

    public function check_email_exists($email, $exclude_id = null) {
        return $this->email_exists($email, $exclude_id);
    }

    // Update user password specifically
    public function update_password($user_id, $password) {
        $data = array(
            'password' => $password,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $user_id)->update('users', $data);
    }

    // Get users with pagination and filters for admin
    public function get_users_admin($limit = 10, $offset = 0, $role = null) {
        $this->db->from('users');
        $this->db->select('id, username, email, first_name, last_name, role, status, created_at, last_login');
        if ($role) {
            $this->db->where('role', $role);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->limit($limit, $offset)->get()->result_array();
    }
}