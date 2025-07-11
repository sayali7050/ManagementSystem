# Hotel Management System

A complete hotel management system built with CodeIgniter 3, featuring room booking, user management, and admin dashboard.

## Features

### Frontend
- **Home Page**: Search for available rooms with filters
- **Room Search**: Advanced search with date, guest, and price filters
- **Room Details**: View detailed room information and amenities
- **User Registration/Login**: Secure authentication system
- **Booking System**: Complete booking flow with confirmation
- **Booking Lookup**: Find existing bookings by reference
- **Customer Dashboard**: Manage bookings and profile
- **Responsive Design**: Mobile-friendly interface

### Backend (Admin)
- **Admin Dashboard**: Overview of bookings, rooms, and statistics
- **Room Management**: Add, edit, and manage rooms
- **Booking Management**: View and manage all bookings
- **User Management**: Manage customer and staff accounts
- **Hotel Management**: Manage multiple hotel locations
- **Reports**: Generate booking and revenue reports

## Installation

### Prerequisites
- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Setup Instructions

1. **Clone/Download the project**
   ```
   Place the project in: C:\xampp\htdocs\ManagementSystem\
   ```

2. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `hotel_management`
   - Import the `database_setup.sql` file or run the SQL commands manually

3. **Configuration**
   - The application is already configured for XAMPP
   - Base URL: `http://localhost/ManagementSystem/`
   - Database: `hotel_management`
   - Default admin credentials:
     - Username: `admin`
     - Password: `password`

4. **Test the Application**
   - Visit: `http://localhost/ManagementSystem/`
   - Test page: `http://localhost/ManagementSystem/test`

## File Structure

```
ManagementSystem/
├── application/
│   ├── controllers/          # Application controllers
│   ├── models/              # Database models
│   ├── views/               # View templates
│   └── config/              # Configuration files
├── system/                  # CodeIgniter core files
├── .htaccess               # URL rewriting rules
├── index.php               # Front controller
└── database_setup.sql      # Database schema
```

## Usage

### For Customers
1. **Browse Rooms**: Visit the home page to see available rooms
2. **Search**: Use the search form to find rooms by date, location, and price
3. **Register/Login**: Create an account or login to make bookings
4. **Book Room**: Select dates and complete the booking process
5. **Manage Bookings**: View and cancel bookings from your dashboard

### For Administrators
1. **Login**: Use admin credentials to access the admin panel
2. **Dashboard**: View system overview and statistics
3. **Manage Rooms**: Add, edit, and update room information
4. **Manage Bookings**: View and update booking statuses
5. **Reports**: Generate reports for business insights

## Troubleshooting

### Common Issues

1. **"Unable to load the requested file" error**
   - Ensure the .htaccess file is present and mod_rewrite is enabled
   - Check that the base URL in config.php is correct

2. **Database connection errors**
   - Verify MySQL is running in XAMPP
   - Check database credentials in `application/config/database.php`
   - Ensure the `hotel_management` database exists

3. **404 errors on all pages**
   - Check that mod_rewrite is enabled in Apache
   - Verify the .htaccess file is in the root directory
   - Ensure the RewriteBase in .htaccess matches your setup

4. **Redirecting to phpMyAdmin**
   - This usually indicates a routing issue
   - Check the .htaccess file configuration
   - Verify the base URL setting

### Testing
- Visit `http://localhost/ManagementSystem/test` to verify the application is working
- Check database connection and basic functionality

## Security Features

- Password hashing using bcrypt
- Session-based authentication
- Role-based access control
- SQL injection prevention
- XSS protection
- CSRF protection

## Technologies Used

- **Backend**: CodeIgniter 3 (PHP)
- **Frontend**: Bootstrap 4, jQuery, Font Awesome
- **Database**: MySQL
- **Server**: Apache (XAMPP)

## Support

If you encounter any issues:
1. Check the troubleshooting section above
2. Verify all prerequisites are installed
3. Ensure the database is properly set up
4. Check Apache error logs for detailed error messages

## License

This project is open source and available under the MIT License. 