<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function create($data) {
        $sql = "INSERT INTO users (username, email, password, fullname, role, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $this->db->query($sql, [
            $data['username'],
            $data['email'],
            $hashedPassword,
            $data['fullname'],
            $data['role'] ?? 0
        ]);
    }
    
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->db->fetch($sql, [$email]);
    }
    
    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        return $this->db->fetch($sql, [$username]);
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function emailExists($email) {
        return $this->findByEmail($email) !== false;
    }
    
    public function usernameExists($username) {
        return $this->findByUsername($username) !== false;
    }
    
    public function getInstructors() {
        $sql = "SELECT id, fullname FROM users WHERE role = 1";
        return $this->db->fetchAll($sql);
    }
}
?>