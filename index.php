<?php

declare(strict_types=1);

require_once __DIR__ . '/App/controller/AuthController.php';
session_start();

$authController = new AuthController();
$authController->handleRequest();

if (isset($_SESSION['username'])) {
    echo "Welcome " . $_SESSION['username'];
} else {
    echo "Not logged in";
}
