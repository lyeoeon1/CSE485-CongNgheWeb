<?php
class HomeController extends Controller {
    private $courseModel;
    private $categoryModel;
    
    public function __construct() {
        $this->courseModel = new Course();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $courses = $this->courseModel->getAll(6); // Get latest 6 courses
        $categories = $this->categoryModel->getAll();
        
        $this->view('home/index', [
            'courses' => $courses,
            'categories' => $categories
        ]);
    }
}
?>