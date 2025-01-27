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
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT id, username, password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result->num_rows === 1) {
            $user = $result;
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
}