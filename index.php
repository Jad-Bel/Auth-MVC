<?php
require_once __DIR__ . '/App/controller/AuthController.php';
require_once __DIR__ . '/App/views/login.php';

$authController = new AuthController();
$authController->handleRequest();


