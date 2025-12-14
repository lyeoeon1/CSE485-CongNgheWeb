<?php
// Entry point của ứng dụng
require_once 'app/Core/Router.php';
require_once 'config/app.php';

// Khởi tạo router
$router = new Router();

// Định tuyến các route
$router->get('/', 'HomeController@index');
$router->get('/courses', 'CourseController@index');
$router->get('/courses/(\d+)', 'CourseController@detail');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@handleLogin');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@handleRegister');
$router->get('/logout', 'AuthController@logout');

// Student routes
$router->get('/student/dashboard', 'StudentController@dashboard');
$router->get('/student/courses', 'StudentController@myCourses');
$router->post('/student/enroll/(\d+)', 'StudentController@enroll');

// Instructor routes
$router->get('/instructor/dashboard', 'InstructorController@dashboard');
$router->get('/instructor/courses', 'InstructorController@manageCourses');
$router->get('/instructor/courses/create', 'InstructorController@createCourse');
$router->post('/instructor/courses/create', 'InstructorController@storeCourse');
$router->get('/instructor/courses/(\d+)/edit', 'InstructorController@editCourse');
$router->post('/instructor/courses/(\d+)/edit', 'InstructorController@updateCourse');
$router->post('/instructor/courses/(\d+)/delete', 'InstructorController@deleteCourse');

// Xử lý request
$router->dispatch();
?>