<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// Authentication routes
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';

// Admin routes
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/rooms'] = 'admin/rooms';
$route['admin/bookings'] = 'admin/bookings';
$route['admin/users'] = 'admin/users';
$route['admin/reports'] = 'admin/reports';
$route['admin/hotels'] = 'admin/hotels';
$route['admin/settings'] = 'admin/settings';

// Customer routes
$route['customer'] = 'customer/dashboard';
$route['customer/dashboard'] = 'customer/dashboard';
$route['customer/profile'] = 'customer/profile';
$route['customer/change-password'] = 'customer/change_password';

// Booking routes
$route['booking/book'] = 'booking/book';
$route['booking/confirmation/(:num)'] = 'booking/confirmation/$1';
$route['booking/lookup'] = 'booking/lookup';
$route['booking/my-bookings'] = 'booking/my_bookings';
$route['booking/cancel/(:num)'] = 'booking/cancel/$1';
$route['booking/invoice/(:num)'] = 'booking/invoice/$1';

// Public routes
$route['search'] = 'home/search';
$route['room/(:num)'] = 'home/room_details/$1';
$route['about'] = 'home/about';
$route['contact'] = 'home/contact';

// API routes
$route['api/check-availability'] = 'api/check_availability';
$route['api/check-username'] = 'api/check_username';
$route['api/check-email'] = 'api/check_email';
$route['api/calculate-price'] = 'api/calculate_price';
$route['api/search-rooms'] = 'api/search_rooms';
$route['api/contact-form'] = 'api/contact_form';

// Customer routes
// $route['rooms'] = 'rooms';
// $route['rooms/(:num)'] = 'rooms/details/$1';
// $route['booking'] = 'booking';
// $route['booking/confirm'] = 'booking/confirm';
// $route['my-bookings'] = 'customer/bookings';
// $route['profile'] = 'customer/profile';

// API routes
// $route['api/rooms'] = 'api/rooms';
// $route['api/booking'] = 'api/booking';
// $route['api/availability'] = 'api/availability';
