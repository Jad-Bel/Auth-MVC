
# Authentication System (Beginner Friendly)

This is a basic authentication system built using PHP, designed for beginners to learn and understand how to create a functional login and registration system. It follows the MVC (Model-View-Controller) design pattern but does not include a router system, keeping it simple and easy to follow.

## Features
- User Registration with hashed passwords.
- User Login with password verification.
- Session-based user authentication.
- MVC architecture for code separation.
- Beginner-friendly and easy to extend.

## Folder Structure

```bash
AuthMVC/
│
├── index.php                   # Entry point of the application
├── App/
│   ├── controller/
│   │   └── AuthController.php  # Controller to handle authentication logic
│   ├── models/
│   │   └── User.php            # Model for database interaction (users table)
│   ├── views/
│   │   ├── register.php        # Registration form view
│   │   └── login.php           # Login form view
├── config/
│   └── Database.php            # Database connection file
└── README.md                   # Project documentation
```

## Prerequisites
- PHP 7.4 or higher
- MySQL or MariaDB
- Composer (optional, for dependency management)
- A local server (e.g., XAMPP, Laragon, or WAMP)

## Installation

### Clone the repository:

```bash
git clone https://github.com/your-username/AuthMVC.git
cd AuthMVC
```

### Set up the database:

Create a database named `auth_system` (or your preferred name).  
Import the following SQL script to create the users table:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

### Configure the database connection:

Edit `config/Database.php` and update the database credentials:

```php
private $host = 'localhost';
private $db_name = 'auth_system';
private $username = 'root'; // or your MySQL username
private $password = '';     // or your MySQL password
```

### Start your local server:

Place the project in your server's root directory (e.g., `htdocs` for XAMPP).  
Visit the project in your browser: `http://localhost/AuthMVC`.

### Access the views:

- Open `http://localhost/AuthMVC/App/views/register.php` to register a user.
- Open `http://localhost/AuthMVC/App/views/login.php` to log in.

## How It Works

### User Registration:
- The user submits a form with their username, email, and password.
- The password is hashed using `password_hash()` and stored in the database.

### User Login:
- The user enters their email and password.
- The system verifies the credentials using `password_verify()` and logs them in if valid.

### Session Management:
- User data (e.g., id, username) is stored in the `$_SESSION` variable after successful login.

### MVC Pattern:
- **Model:** Handles database operations (e.g., `User.php`).
- **View:** Displays HTML forms and user interface (e.g., `register.php`, `login.php`).
- **Controller:** Contains the logic to handle requests and responses (e.g., `AuthController.php`).

## Limitations
- No router system; actions are handled directly through POST requests.
- No advanced validation (e.g., email validation, password strength).
- No CSRF protection.

## Future Improvements
- Add a routing system for better URL management.
- Implement password reset functionality.
- Include email validation and password strength checks.
- Add role-based access control (e.g., admin, user).
