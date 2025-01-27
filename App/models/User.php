<?php

require_once __DIR__ . '/../../config/Database.php';

class User {
    private $conn;

    public function __construct() 
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register ($username, $email, $password) 
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        return $stmt->execute();
    }

    
}