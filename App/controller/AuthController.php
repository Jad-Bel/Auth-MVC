<?php

require_once  __DIR__ . '/../models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function handleRequest () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = isset($_POST["action"]) ? $_POST["action"] : '';

            switch ($action) {
                case 'register':
                    $this->handleRegister();
                    break;
                case 'login':
                    $this->handleLogin();
                    break;
                default:
                $this->redirectWithError('Invalid action');
            }
        }
    }

    private function handleRegister () {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $this->redirectWithError('All fields are required');
        }

        if ($password !== $confirm_password) {
            $this->redirectWithError('Passwords do not match');
        }

        if ($this->user->register($username, $email, $password)) {
            $this->redirectWithSuccess('Registration successful', '../AuthMVC/App/views/login.php');

        } else {
            echo 'Registration failed';
        }
    }

    private function handleLogin () {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $this->redirectWithError('Email and password are required');
        }

        $user = $this->user->login($email, $password);


        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $this->redirectWithSuccess('Login successful', '/../../index.php');
            exit;
        } else {
            $this->redirectWithError('Invalid email or password');
        }
    }

    private function redirectWithError($message, $page = '') {
        $_SESSION['error'] = $message;
        $this->redirect($page);
    }

    private function redirectWithSuccess($message, $page = '') {
        $_SESSION['success'] = $message;
        $this->redirect($page);
    }

    private function redirect($page = '') {
        if (empty($page)) {
            $page = $_SERVER['HTTP_REFERER'] ?? '../../index.php';
        }
        header("Location: $page");
        exit();
    }
}