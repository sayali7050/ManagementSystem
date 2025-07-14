<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get all hotels
    public function get_hotels($limit = 10, $offset = 0) {
        $this->db->order_by('name');
        return $this->db->limit($limit, $offset)->get('hotels')->result();
    }

    // Get hotel by ID
    public function get_hotel($id) {
        return $this->db->where('id', $id)->get('hotels')->row();
    }

    // Create new hotel
    public function create_hotel($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('hotels', $data);
    }

    // Update hotel
    public function update_hotel($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update('hotels', $data);
    }

    // Delete hotel
    public function delete_hotel($id) {
        return $this->db->where('id', $id)->delete('hotels');
    }

    // Count hotels
    public function count_hotels() {
        return $this->db->count_all('hotels');
    }

    // Get hotels with room count
    public function get_hotels_with_rooms() {
        $this->db->select('h.*, COUNT(r.id) as room_count');
        $this->db->from('hotels h');
        $this->db->join('rooms r', 'h.id = r.hotel_id', 'left');
        $this->db->group_by('h.id');
        $this->db->order_by('h.name');
        return $this->db->get()->result();
    }

    // Search hotels
    public function search_hotels($keyword, $city = null) {
        $this->db->like('name', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->or_like('address', $keyword);
        
        if ($city) {
            $this->db->where('city', $city);
        }
        
        $this->db->where('status', 'active');
        $this->db->order_by('star_rating', 'DESC');
        return $this->db->get('hotels')->result();
    }

    // Get active hotels only
    public function get_active_hotels() {
        return $this->db->where('status', 'active')->order_by('name')->get('hotels')->result();
    }

    // Additional methods for Admin controller
    public function get_hotel_by_id($hotel_id) {
        return $this->db->where('id', $hotel_id)->get('hotels')->row_array();
    }

    // Get hotels with pagination and filters
    public function get_hotels_admin($limit = 10, $offset = 0, $filters = array()) {
        $this->db->select('h.*, COUNT(r.id) as room_count, AVG(r.price_per_night) as avg_price');
        $this->db->from('hotels h');
        $this->db->join('rooms r', 'h.id = r.hotel_id', 'left');
        
        if (!empty($filters['status'])) {
            $this->db->where('h.status', $filters['status']);
        }
        if (!empty($filters['city'])) {
            $this->db->like('h.city', $filters['city']);
        }
        
        $this->db->group_by('h.id');
        $this->db->order_by('h.name');
        return $this->db->limit($limit, $offset)->get()->result_array();
    }

    // Count hotels with filters
    public function count_hotels_admin($filters = array()) {
        $this->db->from('hotels h');
        
        if (!empty($filters['status'])) {
            $this->db->where('h.status', $filters['status']);
        }
        if (!empty($filters['city'])) {
            $this->db->like('h.city', $filters['city']);
        }
        
        return $this->db->count_all_results();
    }
}