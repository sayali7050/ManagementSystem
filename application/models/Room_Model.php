<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get all rooms with hotel and room type info
    public function get_rooms($limit = 10, $offset = 0, $filters = array()) {
        $this->db->select('r.*, h.name as hotel_name, rt.name as room_type_name, rt.max_occupancy');
        $this->db->from('rooms r');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        
        // Apply filters
        if (!empty($filters['hotel_id'])) {
            $this->db->where('r.hotel_id', $filters['hotel_id']);
        }
        if (!empty($filters['room_type_id'])) {
            $this->db->where('r.room_type_id', $filters['room_type_id']);
        }
        if (!empty($filters['status'])) {
            $this->db->where('r.status', $filters['status']);
        }
        if (!empty($filters['min_price'])) {
            $this->db->where('r.price_per_night >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $this->db->where('r.price_per_night <=', $filters['max_price']);
        }
        
        $this->db->order_by('h.name, r.room_number');
        return $this->db->limit($limit, $offset)->get()->result();
    }

    // Get room by ID with full details
    public function get_room($id) {
        $this->db->select('r.*, h.name as hotel_name, h.address, h.city, h.rating, rt.name as room_type_name, rt.description as room_type_description, rt.max_occupancy');
        $this->db->from('rooms r');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->where('r.id', $id);
        return $this->db->get()->row();
    }

    // Check room availability for specific dates
    public function check_availability($room_id, $check_in, $check_out) {
        $this->db->where('room_id', $room_id);
        $this->db->where('status !=', 'cancelled');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where('check_in_date <=', $check_in);
                $this->db->where('check_out_date >', $check_in);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('check_in_date <', $check_out);
                $this->db->where('check_out_date >=', $check_out);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('check_in_date >=', $check_in);
                $this->db->where('check_out_date <=', $check_out);
            $this->db->group_end();
        $this->db->group_end();
        
        $conflicts = $this->db->count_all_results('bookings');
        return $conflicts == 0;
    }

    // Get available rooms for date range
    public function get_available_rooms($check_in, $check_out, $guests = 1, $filters = array()) {
        $this->db->select('r.*, h.name as hotel_name, h.rating, rt.name as room_type_name, rt.max_occupancy');
        $this->db->from('rooms r');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->where('r.status', 'available');
        $this->db->where('rt.max_occupancy >=', $guests);
        
        // Apply filters
        if (!empty($filters['hotel_id'])) {
            $this->db->where('r.hotel_id', $filters['hotel_id']);
        }
        if (!empty($filters['room_type_id'])) {
            $this->db->where('r.room_type_id', $filters['room_type_id']);
        }
        if (!empty($filters['min_price'])) {
            $this->db->where('r.price_per_night >=', $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $this->db->where('r.price_per_night <=', $filters['max_price']);
        }
        
        // Exclude rooms that are already booked
        $this->db->where('r.id NOT IN (
            SELECT DISTINCT room_id FROM bookings 
            WHERE status != "cancelled" 
            AND (
                (check_in_date <= "' . $check_in . '" AND check_out_date > "' . $check_in . '")
                OR (check_in_date < "' . $check_out . '" AND check_out_date >= "' . $check_out . '")
                OR (check_in_date >= "' . $check_in . '" AND check_out_date <= "' . $check_out . '")
            )
        )', NULL, FALSE);
        
        $this->db->order_by('r.price_per_night');
        return $this->db->get()->result();
    }

    // Create new room
    public function create_room($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('rooms', $data);
    }

    // Update room
    public function update_room($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update('rooms', $data);
    }

    // Delete room
    public function delete_room($id) {
        return $this->db->where('id', $id)->delete('rooms');
    }

    // Count rooms
    public function count_rooms($filters = array()) {
        $this->db->from('rooms r');
        
        if (!empty($filters['hotel_id'])) {
            $this->db->where('r.hotel_id', $filters['hotel_id']);
        }
        if (!empty($filters['status'])) {
            $this->db->where('r.status', $filters['status']);
        }
        
        return $this->db->count_all_results();
    }

    // Get room types
    public function get_room_types() {
        return $this->db->order_by('base_price')->get('room_types')->result();
    }

    // Get room type by ID
    public function get_room_type($id) {
        return $this->db->where('id', $id)->get('room_types')->row();
    }

    // Create room type
    public function create_room_type($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('room_types', $data);
    }

    // Update room type
    public function update_room_type($id, $data) {
        return $this->db->where('id', $id)->update('room_types', $data);
    }

    // Delete room type
    public function delete_room_type($id) {
        return $this->db->where('id', $id)->delete('room_types');
    }

    // Update room status
    public function update_status($id, $status) {
        $data = array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        return $this->db->where('id', $id)->update('rooms', $data);
    }

    // Get rooms by hotel
    public function get_rooms_by_hotel($hotel_id) {
        $this->db->select('r.*, rt.name as room_type_name, rt.max_occupancy');
        $this->db->from('rooms r');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->where('r.hotel_id', $hotel_id);
        $this->db->order_by('r.room_number');
        return $this->db->get()->result();
    }

    // Get room statistics
    public function get_room_stats() {
        $stats = array();
        
        // Total rooms
        $stats['total_rooms'] = $this->db->count_all('rooms');
        
        // Rooms by status
        $this->db->select('status, COUNT(*) as count');
        $this->db->group_by('status');
        $status_stats = $this->db->get('rooms')->result();
        foreach ($status_stats as $stat) {
            $stats['by_status'][$stat->status] = $stat->count;
        }
        
        // Average price
        $this->db->select('AVG(price_per_night) as avg_price');
        $avg_price = $this->db->get('rooms')->row();
        $stats['avg_price'] = round($avg_price->avg_price, 2);
        
        return $stats;
    }
}