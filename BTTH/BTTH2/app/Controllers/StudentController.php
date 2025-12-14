<?php
class StudentController extends Controller {
    private $enrollmentModel;
    private $courseModel;
    
    public function __construct() {
        $this->enrollmentModel = new Enrollment();
        $this->courseModel = new Course();
    }
    
    public function dashboard() {
        $this->requireRole(0); // Student only
        
        $myCourses = $this->enrollmentModel->getStudentCourses($_SESSION['user_id']);
        
        $this->view('student/dashboard', [
            'myCourses' => $myCourses
        ]);
    }
    
    public function myCourses() {
        $this->requireRole(0); // Student only
        
        $myCourses = $this->enrollmentModel->getStudentCourses($_SESSION['user_id']);
        
        $this->view('student/my_courses', [
            'myCourses' => $myCourses
        ]);
    }
    
    public function enroll($courseId) {
        $this->requireRole(0); // Student only
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/courses');
        }
        
        $course = $this->courseModel->findById($courseId);
        if (!$course) {
            $_SESSION['error'] = 'Khóa học không tồn tại';
            $this->redirect('/courses');
        }
        
        if ($this->enrollmentModel->enroll($_SESSION['user_id'], $courseId)) {
            $_SESSION['success'] = 'Đăng ký khóa học thành công';
        } else {
            $_SESSION['error'] = 'Bạn đã đăng ký khóa học này rồi';
        }
        
        $this->redirect('/courses/' . $courseId);
    }
}
?>