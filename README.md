# Employee Management System - PHP CMS Assignment

This is my PHP CMS assignment for the Employee Management System. I created this project as part of my coursework to learn PHP and MySQL.

## Project Overview

This is a basic Content Management System (CMS) built with vanilla PHP and MySQL. The system allows administrators to manage employees, departments, and projects. It includes a public-facing website that displays employee information and company statistics.

## Features

### Admin Panel
- **Dashboard**: Overview of company statistics and recent employees
- **Employee Management**: Add, edit, delete, and view employee information
- **Department Management**: Create and manage company departments
- **Project Management**: Manage company projects (from original CMS)
- **User Management**: Admin user accounts

### Public Website
- **Company Statistics**: Display total employees, departments, etc.
- **Employee Directory**: Show all active employees with their details
- **Department Overview**: List all departments with employee counts

## Database Structure

The system uses the following main tables:
- `employees`: Stores employee information (name, email, department, salary, etc.)
- `departments`: Stores department information
- `users`: Admin user accounts
- `projects`: Company projects (from original CMS)

## Setup Instructions

### Prerequisites
- XAMPP or similar local server with PHP and MySQL
- Web browser

### Installation Steps

1. **Set up the database:**
   - Open phpMyAdmin
   - Create a new database called `employee_cms`
   - Import the `admin/employee_cms.sql` file

2. **Configure database connection:**
   - Edit `admin/includes/database.php`
   - Update the database credentials if needed (default uses localhost/root)

3. **Set up admin user:**
   - The default admin user is: `admin@company.com`
   - Password: You'll need to update the MD5 hash in the SQL file
   - To generate MD5 hash for "admin123": use an online MD5 generator

4. **Access the system:**
   - Public website: `http://localhost/employee-cms/`
   - Admin panel: `http://localhost/employee-cms/admin/`

## File Structure

```
employee-cms/
├── admin/
│   ├── includes/
│   │   ├── database.php      # Database connection
│   │   ├── config.php        # Basic configuration
│   │   ├── functions.php     # Helper functions
│   │   ├── header.php        # Admin header
│   │   └── footer.php        # Admin footer
│   ├── dashboard.php         # Admin dashboard
│   ├── employees.php         # Employee listing
│   ├── employees_add.php     # Add new employee
│   ├── employees_edit.php    # Edit employee
│   ├── departments.php       # Department management
│   ├── projects.php          # Project management
│   ├── users.php             # User management
│   ├── index.php             # Admin login
│   ├── logout.php            # Logout
│   ├── styles.css            # Admin styling
│   └── employee_cms.sql      # Database structure
├── index.php                 # Public website
└── README.md                 # This file
```

## Student Notes

This project was created as part of my PHP CMS assignment. I learned a lot about:
- PHP basics and syntax
- MySQL database operations
- Form handling and validation
- Session management
- Basic security concepts
- HTML/CSS for styling

### What I learned:
- How to connect PHP to MySQL databases
- Basic CRUD operations (Create, Read, Update, Delete)
- Form validation and error handling
- Session-based authentication
- Basic SQL queries and joins
- Responsive web design with CSS Grid

### Challenges I faced:
- Understanding PHP syntax and logic
- Database relationship concepts
- Form validation and security
- CSS styling and layout
- Debugging PHP errors

## Security Notes

This is a student project with basic security. In a real-world application, you would need:
- Password hashing (not MD5)
- SQL injection prevention (prepared statements)
- Input validation and sanitization
- CSRF protection
- HTTPS encryption

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3
- **Editor**: CKEditor (for rich text editing)
- **Icons**: Font Awesome (optional)

## License

This is a student project created for educational purposes.

---

**Student Name**: [Your Name]  
**Course**: [Course Name]  
**Date**: [Submission Date] 