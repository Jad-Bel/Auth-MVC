<?php

class Database {
    private $host = 'localhost';
    private $un = 'your_ussername';
    private $pw = 'your_password';
    private $db = 'your_database';
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->un, $this->pw);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}