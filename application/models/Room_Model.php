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

    // Get rooms with advanced filters (including capacity and features)
    public function get_rooms_with_filters($limit = 10, $offset = 0, $filters = array()) {
        $this->db->select('r.*, h.name as hotel_name, h.star_rating, rt.name as room_type_name, rt.max_occupancy, rt.amenities');
        $this->db->from('rooms r');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        
        // Apply basic filters
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
        
        // Apply capacity filter
        if (!empty($filters['capacity'])) {
            $capacity_map = ['1' => 1, '2' => 2, '3' => 3, '4' => 4];
            if (isset($capacity_map[$filters['capacity']])) {
                $this->db->where('rt.max_occupancy >=', $capacity_map[$filters['capacity']]);
            }
        }
        
        // Apply features filter
        if (!empty($filters['features']) && is_array($filters['features'])) {
            foreach ($filters['features'] as $feature) {
                // Map feature value to label in amenities string
                $featureLabel = '';
                if ($feature === 'wifi') $featureLabel = 'Wi-Fi';
                if ($feature === 'balcony') $featureLabel = 'Balcony';
                if ($feature === 'kitchenette') $featureLabel = 'Kitchenette';
                if ($featureLabel) {
                    $this->db->like('rt.amenities', $featureLabel);
                }
            }
        }
        
        $this->db->order_by('r.price_per_night');
        return $this->db->limit($limit, $offset)->get()->result();
    }

    // Get room by ID with full details
    public function get_room($id) {
        $this->db->select('r.*, h.name as hotel_name, h.address, h.city, h.star_rating, rt.name as room_type_name, rt.description as description, rt.max_occupancy');
        $this->db->from('rooms r');
        $this->db->join('hotels h', 'r.hotel_id = h.id');
        $this->db->join('room_types rt', 'r.room_type_id = rt.id');
        $this->db->where('r.id', $id);
        return $this->db->get()->row();
    }

    // Get room by ID as array (for compatibility with Booking controller)
    public function get_room_by_id($id) {
        $room = $this->get_room($id);
        return $room ? (array) $room : null;
    }

    // Check room availability for specific dates
    public function check_availability($room_id, $check_in, $check_out) {
        $this->db->where('room_id', $room_id);
        $this->db->where('booking_status !=', 'cancelled');
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
        // Override guests with capacity filter if set
        if (!empty($filters['capacity'])) {
            $capacity_map = ['1' => 1, '2' => 2, '3' => 3, '4' => 4];
            if (isset($capacity_map[$filters['capacity']])) {
                $guests = $capacity_map[$filters['capacity']];
            }
        }
        
        $this->db->select('r.*, h.name as hotel_name, h.star_rating, rt.name as room_type_name, rt.max_occupancy, rt.amenities');
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
        if (!empty($filters['features']) && is_array($filters['features'])) {
            foreach ($filters['features'] as $feature) {
                // Map feature value to label in amenities string
                $featureLabel = '';
                if ($feature === 'wifi') $featureLabel = 'Wi-Fi';
                if ($feature === 'balcony') $featureLabel = 'Balcony';
                if ($feature === 'kitchenette') $featureLabel = 'Kitchenette';
                if ($featureLabel) {
                    $this->db->like('rt.amenities', $featureLabel);
                }
            }
        }
        
        // Exclude rooms that are already booked
        $this->db->where('r.id NOT IN (
            SELECT DISTINCT room_id FROM bookings 
            WHERE bookings.booking_status != "cancelled" 
            AND (
                (check_in_date <= "' . $check_in . '" AND check_out_date > "' . $check_in . '")
                OR (check_in_date < "' . $check_out . '" AND check_out_date >= "' . $check_out . '")
                OR (check_in_date >= "' . $check_in . '" AND check_out_date <= "' . $check_out . '")
            )
        )', NULL, FALSE);
        
        $this->db->order_by('r.price_per_night');
        
        // Debug: Log the SQL query
        $query = $this->db->get_compiled_select();
        error_log('SQL Query: ' . $query);
        
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
        $this->db->from('room_types');
        $this->db->order_by('base_price');
        return $this->db->get()->result();
    }

    // Get room type by ID
    public function get_room_type($id) {
        $this->db->from('room_types');
        $this->db->where('id', $id);
        return $this->db->get()->row();
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