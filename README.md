# Brew Haven - Coffee Shop E-Commerce Platform

A full-featured transactional website for "Brew Haven" coffee shop built using CodeIgniter 4 PHP framework. This project demonstrates a complete e-commerce solution with customer ordering system and administrative management capabilities.

## Features

### Customer Features
- User Authentication - Secure registration and login system
- Product Catalog - Browse available coffee drinks with detailed descriptions
- Drink Customization - Customize size, milk type, and sweetness levels
- Shopping Cart - Real-time cart management with quantity updates
- Order Management - Complete checkout process with order history tracking
- Order Confirmation - Automatic email receipts upon successful orders
- User Profiles - Manage account information and profile pictures

### Admin Features
- User Management - Comprehensive user administration with role-based access
- Product Management - Full CRUD operations for products with image upload
- Inventory Tracking - Stock level monitoring with low-stock alerts
- Order Dashboard - View order statistics and revenue reports
- Search & Pagination - Efficient data navigation for large datasets

## Technology Stack

- Framework: CodeIgniter 4
- Language: PHP 8.1+
- Database: MySQL
- Frontend: HTML, CSS, JavaScript, Bootstrap
- Security: CSRF protection, input validation, password hashing

## Installation

1. Prerequisites
   - PHP 8.1 or higher with intl and mbstring extensions
   - MySQL database
   - Web server (Apache/Nginx)

2. Setup Steps
   - Clone the project: git clone [repository-url]
   - Navigate to project: cd brew-haven
   - Configure environment: cp env .env
   - Edit .env file with your database credentials
   - Install dependencies: composer install
   - Import the provided SQL database file
   - Configure web server to point to the public directory

## Project Structure

app/
  Config/ - Configuration files
  Controllers/ - Application logic
  Models/ - Database operations
  Views/ - User interface templates
  Database/ - Migrations and seeds
public/ - Web root (assets, uploads)
writable/ - Logs and cache

## Key Implementation Details

- MVC Architecture - Clean separation of concerns
- Form Validation - Server-side and client-side validation
- Session Management - Secure user authentication
- File Upload Handling - Image processing and security
- Database Transactions - Data integrity during orders
- Email Integration - Order confirmation system

## Development Insights

This project emphasized the importance of proper planning and database design from the outset. Implementing clear user roles and robust validation early prevented numerous issues during development. The integration of security measures with user experience demonstrated how both aspects are fundamentally connected in creating professional web applications.

## Security Features

- Password hashing with PHP password_hash()
- CSRF protection on all forms
- Input validation and data sanitization
- SQL injection prevention through Query Builder
- File upload restrictions and validation
- Session-based authentication

## License

This project was developed for educational purposes as part of a technical assessment.

## Project Structure

```
app/
├── Config/          # Configuration files
├── Controllers/     # Application logic
├── Models/          # Database operations
├── Views/           # User interface templates
├── Database/        # Migrations and seeds
public/              # Web root (assets, uploads)
writable/            # Logs and cache
```

## Key Implementation Details

- **MVC Architecture** - Clean separation of concerns
- **Form Validation** - Server-side and client-side validation
- **Session Management** - Secure user authentication
- **File Upload Handling** - Image processing and security
- **Database Transactions** - Data integrity during orders
- **Email Integration** - Order confirmation system

## Development Insights

This project emphasized the importance of proper planning and database design from the outset. Implementing clear user roles and robust validation early prevented numerous issues during development. The integration of security measures with user experience demonstrated how both aspects are fundamentally connected in creating professional web applications.

## Security Features

- Password hashing with PHP password_hash()
- CSRF protection on all forms
- Input validation and data sanitization
- SQL injection prevention through Query Builder
- File upload restrictions and validation
- Session-based authentication

## License

This project was developed for educational purposes as part of a technical assessment.
