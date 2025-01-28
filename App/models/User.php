<?php

require_once __DIR__ . '/../../config/Database.php';

class User {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $created_at;
    protected $conn;

    public function __construct()
    {
        $db = new database();
        $this->conn = $db->getConnection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new \Exception("Invalid email format.");
        }
    }

    public function setPassword($password)
    {
        $this->password = $this->hashPassword($password);
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    

    public function save()
    {

        $checkEmailSql = "SELECT id FROM users WHERE email = :email";
        $checkEmailStmt = $this->conn->prepare($checkEmailSql);
        $checkEmailStmt->execute(['email' => $this->email]);
        $existingUser = $checkEmailStmt->fetch(\PDO::FETCH_ASSOC);

        if ($existingUser) {
            header('location: register.php');
        }

        $sql = "INSERT INTO users (username, email, password, role, created_at)
                VALUES (:username, :email, :password, :role, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ]);
        $this->id = $this->conn->lastInsertId();
        return true;
    }

    public function getByEmail($email, $password) {
        $query = "SELECT id, username, password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = $result;
            if (password_verify($password, $user['password'])) {
                return [
                    'id' => $result['id'],
                    'username' => $result['username']
                ];    
            }
        } else {
            return false;
        }
    }

    protected function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}