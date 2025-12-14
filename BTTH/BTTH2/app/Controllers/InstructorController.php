<?php
class InstructorController extends Controller {
    private $courseModel;
    private $categoryModel;
    private $enrollmentModel;
    
    public function __construct() {
        $this->courseModel = new Course();
        $this->categoryModel = new Category();
        $this->enrollmentModel = new Enrollment();
    }
    
    public function dashboard() {
        $this->requireRole(1); // Instructor only
        
        $myCourses = $this->courseModel->getByInstructor($_SESSION['user_id']);
        
        $this->view('instructor/dashboard', [
            'myCourses' => $myCourses
        ]);
    }
    
    public function manageCourses() {
        $this->requireRole(1); // Instructor only
        
        $myCourses = $this->courseModel->getByInstructor($_SESSION['user_id']);
        
        $this->view('instructor/course_manage', [
            'courses' => $myCourses
        ]);
    }
    
    public function createCourse() {
        $this->requireRole(1); // Instructor only
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $categories = $this->categoryModel->getAll();
            $this->view('instructor/course_create', [
                'categories' => $categories
            ]);
        }
    }
    
    public function storeCourse() {
        $this->requireRole(1); // Instructor only
        
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $categoryId = $_POST['category_id'] ?? '';
        $price = $_POST['price'] ?? 0;
        $durationWeeks = $_POST['duration_weeks'] ?? 1;
        $level = $_POST['level'] ?? 'Beginner';
        
        if (empty($title) || empty($description)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            $this->redirect('/instructor/courses/create');
        }
        
        $courseData = [
            'title' => $title,
            'description' => $description,
            'instructor_id' => $_SESSION['user_id'],
            'category_id' => $categoryId,
            'price' => $price,
            'duration_weeks' => $durationWeeks,
            'level' => $level,
            'image' => null
        ];
        
        if ($this->courseModel->create($courseData)) {
            $_SESSION['success'] = 'Tạo khóa học thành công';
            $this->redirect('/instructor/courses');
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
            $this->redirect('/instructor/courses/create');
        }
    }
    
    public function editCourse($id) {
        $this->requireRole(1); // Instructor only
        
        $course = $this->courseModel->findById($id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Không có quyền truy cập';
            $this->redirect('/instructor/courses');
        }
        
        $categories = $this->categoryModel->getAll();
        
        $this->view('instructor/course_edit', [
            'course' => $course,
            'categories' => $categories
        ]);
    }
    
    public function updateCourse($id) {
        $this->requireRole(1); // Instructor only
        
        $course = $this->courseModel->findById($id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Không có quyền truy cập';
            $this->redirect('/instructor/courses');
        }
        
        $courseData = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'category_id' => $_POST['category_id'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'duration_weeks' => $_POST['duration_weeks'] ?? 1,
            'level' => $_POST['level'] ?? 'Beginner',
            'image' => $course['image'] // Keep existing image for now
        ];
        
        if ($this->courseModel->update($id, $courseData)) {
            $_SESSION['success'] = 'Cập nhật khóa học thành công';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
        }
        
        $this->redirect('/instructor/courses');
    }
    
    public function deleteCourse($id) {
        $this->requireRole(1); // Instructor only
        
        $course = $this->courseModel->findById($id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'Không có quyền truy cập';
            $this->redirect('/instructor/courses');
        }
        
        if ($this->courseModel->delete($id)) {
            $_SESSION['success'] = 'Xóa khóa học thành công';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
        }
        
        $this->redirect('/instructor/courses');
    }
}
?>