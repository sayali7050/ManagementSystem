<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "<h1>Hotel Management System - Test Page</h1>";
        echo "<p>If you can see this page, your CodeIgniter application is working correctly!</p>";
        echo "<p>Base URL: " . base_url() . "</p>";
        echo "<p>Current URL: " . current_url() . "</p>";
        echo "<p>Site URL: " . site_url() . "</p>";
        
        // Test database connection
        if ($this->db->simple_query('SELECT 1')) {
            echo "<p style='color: green;'>✓ Database connection successful</p>";
        } else {
            echo "<p style='color: red;'>✗ Database connection failed</p>";
        }
        
        // Test session
        if ($this->session) {
            echo "<p style='color: green;'>✓ Session library loaded</p>";
        } else {
            echo "<p style='color: red;'>✗ Session library not loaded</p>";
        }
        
        echo "<br><a href='" . base_url() . "'>Go to Home Page</a>";
    }
} 