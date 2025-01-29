<?php

namespace AuthMVC\App\models\Admin;

use AuthMVC\config\Database\Database;

class Admin
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $conn;

    public function __construct()
    {
        $db = new Database;
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
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getByEmail($email, $password) {
        $query = "SELECT id, username, password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

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

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    private function updateUserStatus($id, $status)
    {
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function banUser($id)
    {
        $this->updateUserStatus($id, 'suspended');
    }

    public function unbanUser($id)
    {
        $this->updateUserStatus($id, 'active');
    }

    public function deleteUser($email)
    {
        if ($this->email == $email) {
            throw new \Exception('Admin cannot delete themselves');
        }
        $query = "DELETE FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
    }
}
