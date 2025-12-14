<?php
class Course {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll($limit = null, $offset = 0) {
        $sql = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name 
                FROM courses c 
                LEFT JOIN users u ON c.instructor_id = u.id 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                ORDER BY c.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        
        return $this->db->fetchAll($sql);
    }
    
    public function findById($id) {
        $sql = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name 
                FROM courses c 
                LEFT JOIN users u ON c.instructor_id = u.id 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                WHERE c.id = ?";
        
        return $this->db->fetch($sql, [$id]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO courses (title, description, instructor_id, category_id, price, 
                duration_weeks, level, image, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        
        return $this->db->query($sql, [
            $data['title'],
            $data['description'],
            $data['instructor_id'],
            $data['category_id'],
            $data['price'],
            $data['duration_weeks'],
            $data['level'],
            $data['image'] ?? null
        ]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE courses SET title = ?, description = ?, category_id = ?, 
                price = ?, duration_weeks = ?, level = ?, image = ?, updated_at = NOW() 
                WHERE id = ?";
        
        return $this->db->query($sql, [
            $data['title'],
            $data['description'],
            $data['category_id'],
            $data['price'],
            $data['duration_weeks'],
            $data['level'],
            $data['image'],
            $id
        ]);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM courses WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
    
    public function getByInstructor($instructorId) {
        $sql = "SELECT c.*, cat.name as category_name 
                FROM courses c 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                WHERE c.instructor_id = ? 
                ORDER BY c.created_at DESC";
        
        return $this->db->fetchAll($sql, [$instructorId]);
    }
    
    public function search($keyword, $categoryId = null) {
        $sql = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name 
                FROM courses c 
                LEFT JOIN users u ON c.instructor_id = u.id 
                LEFT JOIN categories cat ON c.category_id = cat.id 
                WHERE (c.title LIKE ? OR c.description LIKE ?)";
        
        $params = ["%$keyword%", "%$keyword%"];
        
        if ($categoryId) {
            $sql .= " AND c.category_id = ?";
            $params[] = $categoryId;
        }
        
        $sql .= " ORDER BY c.created_at DESC";
        
        return $this->db->fetchAll($sql, $params);
    }
}
?>