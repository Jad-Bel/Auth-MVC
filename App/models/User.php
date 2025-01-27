<?php

require_once __DIR__ . '/../../config/Database.php';

class User {
    private $db;

    public function __construct() 
    {
        $this->db = new Database();
    }
}