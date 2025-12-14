<?php
class CourseController extends Controller {
    private $courseModel;
    private $categoryModel;
    private $enrollmentModel;
    
    public function __construct() {
        $this->courseModel = new Course();
        $this->categoryModel = new Category();
        $this->enrollmentModel = new Enrollment();
    }
    
    public function index() {
        $keyword = $_GET['search'] ?? '';
        $categoryId = $_GET['category'] ?? null;
        
        if ($keyword || $categoryId) {
            $courses = $this->courseModel->search($keyword, $categoryId);
        } else {
            $courses = $this->courseModel->getAll();
        }
        
        $categories = $this->categoryModel->getAll();
        
        $this->view('courses/index', [
            'courses' => $courses,
            'categories' => $categories,
            'keyword' => $keyword,
            'selectedCategory' => $categoryId
        ]);
    }
    
    public function detail($id) {
        $course = $this->courseModel->findById($id);
        
        if (!$course) {
            http_response_code(404);
            echo "Course not found";
            return;
        }
        
        $isEnrolled = false;
        if (isset($_SESSION['user_id'])) {
            $isEnrolled = $this->enrollmentModel->isEnrolled($_SESSION['user_id'], $id);
        }
        
        $this->view('courses/detail', [
            'course' => $course,
            'isEnrolled' => $isEnrolled
        ]);
    }
}
?>