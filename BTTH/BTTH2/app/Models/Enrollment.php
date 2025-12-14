<?php
class Enrollment {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function enroll($studentId, $courseId) {
        // Check if already enrolled
        if ($this->isEnrolled($studentId, $courseId)) {
            return false;
        }
        
        $sql = "INSERT INTO enrollments (course_id, student_id, enrolled_date, status, progress) 
                VALUES (?, ?, NOW(), 'active', 0)";
        
        return $this->db->query($sql, [$courseId, $studentId]);
    }
    
    public function isEnrolled($studentId, $courseId) {
        $sql = "SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?";
        return $this->db->fetch($sql, [$studentId, $courseId]) !== false;
    }
    
    public function getStudentCourses($studentId) {
        $sql = "SELECT c.*, e.enrolled_date, e.status, e.progress, u.fullname as instructor_name 
                FROM enrollments e 
                JOIN courses c ON e.course_id = c.id 
                LEFT JOIN users u ON c.instructor_id = u.id 
                WHERE e.student_id = ? 
                ORDER BY e.enrolled_date DESC";
        
        return $this->db->fetchAll($sql, [$studentId]);
    }
    
    public function getCourseStudents($courseId) {
        $sql = "SELECT u.*, e.enrolled_date, e.status, e.progress 
                FROM enrollments e 
                JOIN users u ON e.student_id = u.id 
                WHERE e.course_id = ? 
                ORDER BY e.enrolled_date DESC";
        
        return $this->db->fetchAll($sql, [$courseId]);
    }
    
    public function updateProgress($studentId, $courseId, $progress) {
        $sql = "UPDATE enrollments SET progress = ? WHERE student_id = ? AND course_id = ?";
        return $this->db->query($sql, [$progress, $studentId, $courseId]);
    }
}
?>