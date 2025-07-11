-- =====================================================
-- HOTEL MANAGEMENT SYSTEM - COMPLETE DATABASE STRUCTURE
-- =====================================================
-- This file contains the complete database schema for the hotel management system
-- covering all frontend and backend functionality

-- Create database
CREATE DATABASE IF NOT EXISTS `hotel_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hotel_management`;

-- =====================================================
-- 1. USERS & AUTHENTICATION TABLES
-- =====================================================

-- Users table - Stores all user accounts (admin, staff, customers)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT 'USA',
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','customer') NOT NULL DEFAULT 'customer',
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_username` (`username`),
  KEY `idx_role` (`role`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User sessions table - For session management
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `idx_user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password reset tokens
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `idx_user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 2. HOTEL & LOCATION TABLES
-- =====================================================

-- Hotels table - Main hotel information
CREATE TABLE IF NOT EXISTS `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'USA',
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `star_rating` tinyint(1) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `images` text DEFAULT NULL, -- JSON array of image URLs
  `featured_image` varchar(255) DEFAULT NULL,
  `check_in_time` time DEFAULT '15:00:00',
  `check_out_time` time DEFAULT '11:00:00',
  `status` enum('active','inactive','maintenance') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_city` (`city`),
  KEY `idx_state` (`state`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Hotel amenities table - Detailed amenities for each hotel
CREATE TABLE IF NOT EXISTS `hotel_amenities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `amenity_name` varchar(100) NOT NULL,
  `amenity_type` enum('general','room','wellness','dining','business','recreation') NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_hotel_id` (`hotel_id`),
  KEY `idx_amenity_type` (`amenity_type`),
  FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 3. ROOM & ACCOMMODATION TABLES
-- =====================================================

-- Room types table - Categories of rooms
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `max_occupancy` int(11) NOT NULL DEFAULT 2,
  `size_sqft` int(11) DEFAULT NULL,
  `bed_type` varchar(100) DEFAULT NULL,
  `amenities` text DEFAULT NULL, -- JSON array of amenities
  `images` text DEFAULT NULL, -- JSON array of image URLs
  `featured_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_is_featured` (`is_featured`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Rooms table - Individual rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `floor` int(11) DEFAULT NULL,
  `wing` varchar(50) DEFAULT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT 0.00,
  `status` enum('available','occupied','maintenance','reserved','out_of_service') NOT NULL DEFAULT 'available',
  `special_notes` text DEFAULT NULL,
  `last_cleaned` timestamp NULL DEFAULT NULL,
  `next_cleaning_due` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hotel_room_number` (`hotel_id`, `room_number`),
  KEY `idx_hotel_id` (`hotel_id`),
  KEY `idx_room_type_id` (`room_type_id`),
  KEY `idx_status` (`status`),
  FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Room images table - Multiple images per room
CREATE TABLE IF NOT EXISTS `room_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_type` enum('main','gallery','thumbnail') NOT NULL DEFAULT 'gallery',
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_room_id` (`room_id`),
  KEY `idx_image_type` (`image_type`),
  FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 4. BOOKING & RESERVATION TABLES
-- =====================================================

-- Bookings table - Main booking information
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_reference` varchar(20) NOT NULL UNIQUE,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `guests` int(11) NOT NULL DEFAULT 1,
  `adults` int(11) NOT NULL DEFAULT 1,
  `children` int(11) NOT NULL DEFAULT 0,
  `infants` int(11) NOT NULL DEFAULT 0,
  `nights` int(11) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','partially_paid','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `booking_status` enum('confirmed','checked_in','checked_out','cancelled','no_show') NOT NULL DEFAULT 'confirmed',
  `special_requests` text DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `cancelled_by` int(11) DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `check_in_time` timestamp NULL DEFAULT NULL,
  `check_out_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_booking_reference` (`booking_reference`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_room_id` (`room_id`),
  KEY `idx_check_in_date` (`check_in_date`),
  KEY `idx_check_out_date` (`check_out_date`),
  KEY `idx_payment_status` (`payment_status`),
  KEY `idx_booking_status` (`booking_status`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Booking guests table - Additional guest information
CREATE TABLE IF NOT EXISTS `booking_guests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `guest_type` enum('primary','additional') NOT NULL DEFAULT 'additional',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_booking_id` (`booking_id`),
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 5. PAYMENT & FINANCIAL TABLES
-- =====================================================

-- Payments table - Payment transactions
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` enum('credit_card','debit_card','paypal','bank_transfer','cash','check') NOT NULL,
  `payment_gateway` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `payment_status` enum('pending','processing','completed','failed','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `gateway_response` text DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_booking_id` (`booking_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_transaction_id` (`transaction_id`),
  KEY `idx_payment_status` (`payment_status`),
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Refunds table - Refund transactions
CREATE TABLE IF NOT EXISTS `refunds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` text NOT NULL,
  `refund_method` varchar(50) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
  `processed_by` int(11) DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_payment_id` (`payment_id`),
  KEY `idx_booking_id` (`booking_id`),
  FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 6. REVIEWS & RATINGS TABLES
-- =====================================================

-- Reviews table - Customer reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
  `title` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `cleanliness_rating` tinyint(1) DEFAULT NULL,
  `service_rating` tinyint(1) DEFAULT NULL,
  `location_rating` tinyint(1) DEFAULT NULL,
  `value_rating` tinyint(1) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `moderated_by` int(11) DEFAULT NULL,
  `moderated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_review` (`booking_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_hotel_id` (`hotel_id`),
  KEY `idx_room_id` (`room_id`),
  KEY `idx_rating` (`rating`),
  KEY `idx_status` (`status`),
  FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`moderated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 7. NOTIFICATIONS & COMMUNICATION TABLES
-- =====================================================

-- Notifications table - System notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` enum('booking_confirmation','booking_reminder','payment_received','booking_cancelled','review_request','system_alert') NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `data` text DEFAULT NULL, -- JSON data
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_type` (`type`),
  KEY `idx_is_read` (`is_read`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Email templates table
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `variables` text DEFAULT NULL, -- JSON array of available variables
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 8. SYSTEM & CONFIGURATION TABLES
-- =====================================================

-- Settings table - System configuration
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL UNIQUE,
  `setting_value` text DEFAULT NULL,
  `setting_type` enum('string','integer','boolean','json','text') NOT NULL DEFAULT 'string',
  `description` text DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Activity logs table - System activity tracking
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `data` text DEFAULT NULL, -- JSON data
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_created_at` (`created_at`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- 9. SAMPLE DATA INSERTION
-- =====================================================

-- Insert default admin user
INSERT INTO `users` (`username`, `email`, `password`, `first_name`, `last_name`, `phone`, `role`, `email_verified`) VALUES
('admin', 'admin@hotel.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'User', '555-123-4567', 'admin', 1),
('staff', 'staff@hotel.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Staff', 'Member', '555-987-6543', 'staff', 1);

-- Insert sample hotels
INSERT INTO `hotels` (`name`, `description`, `short_description`, `address`, `city`, `state`, `zip_code`, `phone`, `email`, `website`, `star_rating`, `amenities`, `status`) VALUES
('Grand Hotel & Spa', 'Luxury hotel in the heart of downtown with world-class amenities and exceptional service.', 'Luxury downtown hotel with spa', '123 Main Street', 'New York', 'NY', '10001', '555-123-4567', 'info@grandhotel.com', 'https://grandhotel.com', 5, '["Wi-Fi", "Spa", "Pool", "Gym", "Restaurant", "Bar", "Concierge"]', 'active'),
('Seaside Resort', 'Beautiful beachfront resort with stunning ocean views and tropical atmosphere.', 'Beachfront resort with ocean views', '456 Ocean Drive', 'Miami', 'FL', '33101', '555-987-6543', 'info@seasideresort.com', 'https://seasideresort.com', 4, '["Wi-Fi", "Beach Access", "Pool", "Restaurant", "Bar", "Water Sports"]', 'active'),
('Mountain View Lodge', 'Cozy mountain lodge with breathtaking views and outdoor activities.', 'Mountain lodge with scenic views', '789 Mountain Road', 'Denver', 'CO', '80201', '555-456-7890', 'info@mountainlodge.com', 'https://mountainlodge.com', 4, '["Wi-Fi", "Hiking Trails", "Restaurant", "Fireplace", "Skiing"]', 'active');

-- Insert sample room types
INSERT INTO `room_types` (`name`, `description`, `short_description`, `base_price`, `max_occupancy`, `size_sqft`, `bed_type`, `amenities`, `is_featured`, `status`) VALUES
('Standard Room', 'Comfortable room with essential amenities for a pleasant stay.', 'Comfortable room with basic amenities', 99.99, 2, 300, '1 Queen Bed', '["Wi-Fi", "TV", "Air Conditioning", "Private Bathroom", "Coffee Maker"]', 0, 'active'),
('Deluxe Room', 'Spacious room with premium amenities and enhanced comfort.', 'Spacious room with premium amenities', 149.99, 3, 400, '1 King Bed or 2 Queen Beds', '["Wi-Fi", "TV", "Air Conditioning", "Private Bathroom", "Coffee Maker", "Mini Bar", "Work Desk"]', 1, 'active'),
('Suite', 'Luxury suite with separate living area and premium amenities.', 'Luxury suite with separate living area', 299.99, 4, 600, '1 King Bed + Sofa Bed', '["Wi-Fi", "TV", "Air Conditioning", "Private Bathroom", "Coffee Maker", "Mini Bar", "Work Desk", "Living Room", "Balcony"]', 1, 'active'),
('Presidential Suite', 'Ultimate luxury with panoramic views and butler service.', 'Ultimate luxury with panoramic views', 599.99, 6, 1000, '1 King Bed + 2 Queen Beds', '["Wi-Fi", "TV", "Air Conditioning", "Private Bathroom", "Coffee Maker", "Mini Bar", "Work Desk", "Living Room", "Balcony", "Butler Service", "Jacuzzi"]', 1, 'active');

-- Insert sample rooms
INSERT INTO `rooms` (`hotel_id`, `room_type_id`, `room_number`, `floor`, `price_per_night`, `status`) VALUES
-- Grand Hotel Rooms
(1, 1, '101', 1, 99.99, 'available'),
(1, 1, '102', 1, 99.99, 'available'),
(1, 2, '201', 2, 149.99, 'available'),
(1, 2, '202', 2, 149.99, 'available'),
(1, 3, '301', 3, 299.99, 'available'),
(1, 4, '401', 4, 599.99, 'available'),
-- Seaside Resort Rooms
(2, 1, '101', 1, 99.99, 'available'),
(2, 2, '201', 2, 149.99, 'available'),
(2, 3, '301', 3, 299.99, 'available'),
(2, 4, '401', 4, 599.99, 'available'),
-- Mountain View Lodge Rooms
(3, 1, '101', 1, 99.99, 'available'),
(3, 2, '201', 2, 149.99, 'available'),
(3, 3, '301', 3, 299.99, 'available');

-- Insert sample hotel amenities
INSERT INTO `hotel_amenities` (`hotel_id`, `amenity_name`, `amenity_type`, `description`, `icon`) VALUES
(1, 'Free Wi-Fi', 'general', 'High-speed internet access throughout the hotel', 'wifi'),
(1, 'Swimming Pool', 'recreation', 'Heated outdoor swimming pool', 'swimming-pool'),
(1, 'Spa & Wellness', 'wellness', 'Full-service spa with massage and treatments', 'spa'),
(1, 'Fitness Center', 'wellness', '24/7 gym with modern equipment', 'dumbbell'),
(1, 'Fine Dining', 'dining', 'Award-winning restaurant with international cuisine', 'utensils'),
(1, 'Concierge Service', 'general', '24/7 concierge assistance', 'concierge-bell'),
(2, 'Beach Access', 'recreation', 'Direct access to private beach', 'umbrella-beach'),
(2, 'Water Sports', 'recreation', 'Kayaking, snorkeling, and water activities', 'water'),
(2, 'Pool Bar', 'dining', 'Poolside bar with tropical drinks', 'cocktail'),
(3, 'Hiking Trails', 'recreation', 'Access to scenic hiking trails', 'hiking'),
(3, 'Skiing', 'recreation', 'Winter skiing and snowboarding', 'skiing'),
(3, 'Mountain View Restaurant', 'dining', 'Restaurant with panoramic mountain views', 'mountain');

-- Insert default settings
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`, `description`, `is_public`) VALUES
('site_name', 'Hotel Management System', 'string', 'Website name', 1),
('site_description', 'Complete hotel booking and management system', 'string', 'Website description', 1),
('contact_email', 'info@hotel.com', 'string', 'Contact email address', 1),
('contact_phone', '555-123-4567', 'string', 'Contact phone number', 1),
('tax_rate', '8.5', 'string', 'Tax rate percentage', 0),
('currency', 'USD', 'string', 'Default currency', 1),
('booking_advance_days', '365', 'string', 'Maximum days in advance for booking', 0),
('cancellation_hours', '24', 'string', 'Hours before check-in for free cancellation', 0),
('maintenance_mode', '0', 'boolean', 'Maintenance mode status', 0);

-- Insert email templates
INSERT INTO `email_templates` (`name`, `subject`, `body`, `variables`) VALUES
('booking_confirmation', 'Booking Confirmation - {booking_reference}', '<h2>Booking Confirmation</h2><p>Dear {customer_name},</p><p>Your booking has been confirmed!</p><p><strong>Booking Reference:</strong> {booking_reference}</p><p><strong>Check-in:</strong> {check_in_date}</p><p><strong>Check-out:</strong> {check_out_date}</p><p><strong>Total Amount:</strong> ${total_amount}</p>', '["booking_reference", "customer_name", "check_in_date", "check_out_date", "total_amount"]'),
('booking_reminder', 'Booking Reminder - {booking_reference}', '<h2>Booking Reminder</h2><p>Dear {customer_name},</p><p>This is a reminder for your upcoming booking.</p><p><strong>Booking Reference:</strong> {booking_reference}</p><p><strong>Check-in:</strong> {check_in_date}</p>', '["booking_reference", "customer_name", "check_in_date"]'),
('payment_received', 'Payment Received - {booking_reference}', '<h2>Payment Received</h2><p>Dear {customer_name},</p><p>We have received your payment for booking {booking_reference}.</p><p><strong>Amount:</strong> ${amount}</p>', '["booking_reference", "customer_name", "amount"]');

-- =====================================================
-- 10. INDEXES FOR PERFORMANCE
-- =====================================================

-- Additional indexes for better performance
CREATE INDEX idx_bookings_dates ON bookings(check_in_date, check_out_date);
CREATE INDEX idx_rooms_hotel_status ON rooms(hotel_id, status);
CREATE INDEX idx_payments_booking_status ON payments(booking_id, payment_status);
CREATE INDEX idx_reviews_hotel_rating ON reviews(hotel_id, rating);
CREATE INDEX idx_notifications_user_read ON notifications(user_id, is_read);
CREATE INDEX idx_activity_logs_user_action ON activity_logs(user_id, action);

-- =====================================================
-- END OF DATABASE STRUCTURE
-- =====================================================

-- Display summary
SELECT 'Database structure created successfully!' as message;
SELECT COUNT(*) as total_tables FROM information_schema.tables WHERE table_schema = 'hotel_management'; 