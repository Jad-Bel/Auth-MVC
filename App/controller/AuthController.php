<?php

use Couchbase\User;

require_once  __DIR__ . '/../models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function handleRequest () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST["action"] ? '';

            switch ($action) {
                case 'register':
                    $this->handleRegister();
                    break;
                case 'login':
                    $this->handleLogin();
                    break;
                default:
                    echo 'Error: Invalid Action';
            }
        }
    }

    private function handleRegister () {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            echo "Error: Password do not match";
            return;
        }

        if ($this->user->register($username, $email, $password)) {
            echo 'Registration successful';
        } else {
            echo 'Registration failed';
        }
    }
}