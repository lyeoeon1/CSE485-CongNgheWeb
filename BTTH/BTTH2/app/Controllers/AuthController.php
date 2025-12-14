<?php
class AuthController extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function login() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }
        
        $this->view('auth/login');
    }
    
    public function handleLogin() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            $this->redirect('/login');
        }
        
        $user = $this->userModel->findByEmail($email);
        
        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['success'] = 'Đăng nhập thành công';
            
            // Redirect based on role
            switch ($user['role']) {
                case 1: // Instructor
                    $this->redirect('/instructor/dashboard');
                    break;
                case 2: // Admin
                    $this->redirect('/admin/dashboard');
                    break;
                default: // Student
                    $this->redirect('/student/dashboard');
            }
        } else {
            $_SESSION['error'] = 'Email hoặc mật khẩu không đúng';
            $this->redirect('/login');
        }
    }
    
    public function register() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/');
        }
        
        $this->view('auth/register');
    }
    
    public function handleRegister() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $fullname = $_POST['fullname'] ?? '';
        $role = $_POST['role'] ?? 0;
        
        // Validation
        if (empty($username) || empty($email) || empty($password) || empty($fullname)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            $this->redirect('/register');
        }
        
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Mật khẩu xác nhận không khớp';
            $this->redirect('/register');
        }
        
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            $this->redirect('/register');
        }
        
        if ($this->userModel->emailExists($email)) {
            $_SESSION['error'] = 'Email đã được sử dụng';
            $this->redirect('/register');
        }
        
        if ($this->userModel->usernameExists($username)) {
            $_SESSION['error'] = 'Tên đăng nhập đã được sử dụng';
            $this->redirect('/register');
        }
        
        // Create user
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'fullname' => $fullname,
            'role' => $role
        ];
        
        if ($this->userModel->create($userData)) {
            $_SESSION['success'] = 'Đăng ký thành công. Vui lòng đăng nhập';
            $this->redirect('/login');
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
            $this->redirect('/register');
        }
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }
}
?>