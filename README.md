# PHP CRUD Application

A simple PHP CRUD (Create, Read, Update, Delete) application for managing employee records.

## Features

- View all employee records
- Add new employee records
- View details of a specific employee
- Update employee information
- Delete employee records

## Requirements

- PHP 7.0 or higher
- MySQL 5.6 or higher
- XAMPP, WAMP, MAMP, or any PHP development environment

## Installation

1. Clone or download this repository to your XAMPP's `htdocs` folder or your web server's root directory.
2. Create a MySQL database named `demo` (or update the database name in `config.php`).
3. Import the `database.sql` file into your MySQL database to create the necessary table and sample data.
4. Update the database connection details in `config.php` if needed.
5. Access the application through your web browser (e.g., `http://localhost/php-crud-app/`).

## File Structure

- `config.php` - Database configuration file
- `index.php` - Main page displaying all records with options for CRUD operations
- `create.php` - Form for adding new employee records
- `read.php` - Page for viewing a single employee record
- `update.php` - Form for updating employee information
- `delete.php` - Functionality for deleting records (integrated in index.php)
- `error.php` - Error page for handling invalid requests
- `database.sql` - SQL script for creating the database and table

## Usage

1. Open the application in your web browser.
2. Click "Add New Employee" to create a new record.
3. Click "View" to see details of a specific employee.
4. Click "Update" to modify employee information.
5. Click "Delete" to remove an employee record.

## Notes

- This application includes basic form validation.
- All database operations use prepared statements to prevent SQL injection.
- The application uses Bootstrap for styling. 