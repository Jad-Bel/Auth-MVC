<?php

namespace AuthMVC\App\controller\AuthController;

require_once '../AuthMVC/App/models/User/User.php';

use AuthMVC\App\models\User\User;


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

        if ($this->user->save()) {
            $this->redirectWithSuccess('Registration successful', '/../AuthMVC/App/views/login.php');

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

        $user = $this->user->getByEmail($email, $password);


        if ($user && $user['role'] == 'user') {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $this->redirectWithSuccess('Login successful', '../AuthMVC/index.php?=home');
        } elseif ($user && $user['role'] == 'admin') {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $this->redirectWithSuccess('Login successful', '../AuthMVC/index.php?=adminDash');
        }   else {
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
        $baseUrl = '/AuthMVC/';

        if (empty($page)) {
            $page = 'index.php';
        }
        header("Location: " . $baseUrl . ltrim($page, '/'));
        exit();
    }
}