<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Create new booking
    public function create_booking($data) {
        $data['booking_reference'] = $this->generate_booking_reference();
        $data['created_at'] = date('Y-m-d H:i:s');
        
        // Calculate total nights
        $check_in = new DateTime($data['check_in_date']);
        $check_out = new DateTime($data['check_out_date']);
        $total_nights = $check_out->diff($check_in)->days;
        
        $data['total_nights'] = $total_nights;
        // Remove room_price, tax_amount, and total_nights if present
        unset($data['room_price']);
        unset($data['tax_amount']);
        unset($data['total_nights']);
        // total_amount should already be calculated in controller
        
        return $this->db->insert('bookings', $data) ? $this->db->insert_id() : false;
    }

    // Generate unique booking reference
    private function generate_booking_reference() {
        do {
            $reference = 'BK' . date('Y') . sprintf('%06d', mt_rand(1, 999999));
            $this->db->from('bookings');
            $this->db->where('booking_reference', $reference);
            $exists = $this->db->count_all_results();
        } while ($exists > 0);
        
        return $reference;
    }

    // Get booking by ID with full details
    public function get_booking($id) {
        $this->db->select('b.*, u.first_name, u.last_name, u.email, u.phone, r.room_number, r.floor, rt.name as room_type, h.name as hotel_name, h.address, h.phone as hotel_phone');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.id', $id);
        return $this->db->get()->row();
    }

    // Get booking by reference (with optional email verification)
    public function get_booking_by_reference($reference, $email = null) {
        $this->db->select('b.*, u.first_name, u.last_name, u.email, u.phone, r.room_number, rt.name as room_type, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.booking_reference', $reference);
        
        if ($email) {
            $this->db->where('u.email', $email);
        }
        
        return $this->db->get()->row_array();
    }

    // Get all bookings with pagination
    public function get_bookings($limit = 10, $offset = 0, $filters = array()) {
        $this->db->select('b.*, u.first_name, u.last_name, r.room_number, rt.name as room_type, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        
        // Apply filters
        if (!empty($filters['status'])) {
            $this->db->where('b.status', $filters['status']);
        }
        if (!empty($filters['payment_status'])) {
            $this->db->where('b.payment_status', $filters['payment_status']);
        }
        if (!empty($filters['user_id'])) {
            $this->db->where('b.user_id', $filters['user_id']);
        }
        if (!empty($filters['hotel_id'])) {
            $this->db->where('r.hotel_id', $filters['hotel_id']);
        }
        if (!empty($filters['check_in_date'])) {
            $this->db->where('b.check_in_date >=', $filters['check_in_date']);
        }
        if (!empty($filters['check_out_date'])) {
            $this->db->where('b.check_out_date <=', $filters['check_out_date']);
        }
        
        $this->db->order_by('b.created_at', 'DESC');
        return $this->db->limit($limit, $offset)->get()->result();
    }

    // Count bookings
    public function count_bookings($filters = array()) {
        $this->db->from('bookings b');
        $this->db->join('rooms r', 'b.room_id = r.id');
        
        if (!empty($filters['status'])) {
            $this->db->where('b.status', $filters['status']);
        }
        if (!empty($filters['payment_status'])) {
            $this->db->where('b.payment_status', $filters['payment_status']);
        }
        if (!empty($filters['user_id'])) {
            $this->db->where('b.user_id', $filters['user_id']);
        }
        if (!empty($filters['hotel_id'])) {
            $this->db->where('r.hotel_id', $filters['hotel_id']);
        }
        
        return $this->db->count_all_results();
    }

    // Update booking
    public function update_booking($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update('bookings', $data);
    }

    // Update booking status
    public function update_status($id, $status) {
        $data = array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $id)->update('bookings', $data);
    }

    // Update payment status
    public function update_payment_status($id, $payment_status) {
        $data = array(
            'payment_status' => $payment_status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $id)->update('bookings', $data);
    }

    // Cancel booking
    public function cancel_booking($id, $reason = '') {
        $data = array(
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $id)->update('bookings', $data);
    }

    // Get today's check-ins
    public function get_todays_checkins() {
        $today = date('Y-m-d');
        $this->db->select('b.*, u.first_name, u.last_name, u.phone, r.room_number, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.check_in_date', $today);
        $this->db->where('b.status', 'confirmed');
        $this->db->order_by('r.room_number');
        return $this->db->get()->result();
    }

    // Get today's check-outs
    public function get_todays_checkouts() {
        $today = date('Y-m-d');
        $this->db->select('b.*, u.first_name, u.last_name, u.phone, r.room_number, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.check_out_date', $today);
        $this->db->where_in('b.status', array('confirmed', 'checked_in'));
        $this->db->order_by('r.room_number');
        return $this->db->get()->result();
    }

    // Get booking statistics
    public function get_booking_stats($date_from = null, $date_to = null) {
        $stats = array();
        
        // Apply date filter if provided
        if ($date_from && $date_to) {
            $this->db->where('created_at >=', $date_from);
            $this->db->where('created_at <=', $date_to);
        }
        
        // Total bookings
        $this->db->from('bookings');
        $stats['total_bookings'] = $this->db->count_all_results();
        
        // Reset query for next count
        $this->db->reset_query();
        
        // Bookings by status
        $this->db->from('bookings');
        $this->db->select('status, COUNT(*) as count');
        if ($date_from && $date_to) {
            $this->db->where('created_at >=', $date_from);
            $this->db->where('created_at <=', $date_to);
        }
        $this->db->group_by('status');
        $status_stats = $this->db->get()->result();
        foreach ($status_stats as $stat) {
            $stats['by_status'][$stat->status] = $stat->count;
        }
        
        // Total revenue
        $this->db->from('bookings');
        $this->db->select('SUM(total_amount) as total_revenue');
        $this->db->where('payment_status', 'paid');
        if ($date_from && $date_to) {
            $this->db->where('created_at >=', $date_from);
            $this->db->where('created_at <=', $date_to);
        }
        $revenue = $this->db->get()->row();
        $stats['total_revenue'] = $revenue->total_revenue ?: 0;
        
        return $stats;
    }

    // Get upcoming bookings (next 7 days)
    public function get_upcoming_bookings($days = 7) {
        $today = date('Y-m-d');
        $future_date = date('Y-m-d', strtotime("+{$days} days"));
        
        $this->db->select('b.*, u.first_name, u.last_name, r.room_number, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.check_in_date >=', $today);
        $this->db->where('b.check_in_date <=', $future_date);
        $this->db->where('b.status', 'confirmed');
        $this->db->order_by('b.check_in_date, r.room_number');
        return $this->db->get()->result();
    }

    // Delete booking (admin only)
    public function delete_booking($id) {
        return $this->db->where('id', $id)->delete('bookings');
    }

    // Additional methods for controller functionality
    public function get_booking_by_id($booking_id, $user_id = null) {
        $this->db->select('b.*, u.first_name, u.last_name, u.email, u.phone, r.room_number, rt.name as room_type, h.name as hotel_name');
        $this->db->from('bookings b');
        $this->db->join('users u', 'b.user_id = u.id');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.id', $booking_id);
        
        if ($user_id) {
            $this->db->where('b.user_id', $user_id);
        }
        
        return $this->db->get()->row_array();
    }

    public function get_booking_reference($booking_id) {
        $this->db->from('bookings');
        $this->db->select('booking_reference');
        $this->db->where('id', $booking_id);
        $booking = $this->db->get()->row();
        return $booking ? $booking->booking_reference : false;
    }

    public function count_user_bookings($user_id) {
        $this->db->from('bookings');
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results();
    }

    public function count_upcoming_bookings($user_id) {
        $today = date('Y-m-d');
        $this->db->from('bookings');
        $this->db->where('user_id', $user_id);
        $this->db->where('check_in_date >=', $today);
        $this->db->where('status', 'confirmed');
        return $this->db->count_all_results();
    }

    public function count_completed_bookings($user_id) {
        $this->db->from('bookings');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'completed');
        return $this->db->count_all_results();
    }

    public function count_cancelled_bookings($user_id) {
        $this->db->from('bookings');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'cancelled');
        return $this->db->count_all_results();
    }

    public function get_user_bookings($user_id, $limit = 10, $offset = 0) {
        $this->db->select('b.*, h.name as hotel_name, r.room_number, rt.name as room_type');
        $this->db->from('bookings b');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.user_id', $user_id);
        $this->db->order_by('b.created_at', 'DESC');
        return $this->db->limit($limit, $offset)->get()->result_array();
    }

    public function get_upcoming_user_bookings($user_id, $limit = 5) {
        $today = date('Y-m-d');
        $this->db->select('b.*, h.name as hotel_name, r.room_number, rt.name as room_type');
        $this->db->from('bookings b');
        $this->db->join('rooms r', 'b.room_id = r.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->where('b.user_id', $user_id);
        $this->db->where('b.check_in_date >=', $today);
        $this->db->where('b.status', 'confirmed');
        $this->db->order_by('b.check_in_date', 'ASC');
        return $this->db->limit($limit)->get()->result_array();
    }
}