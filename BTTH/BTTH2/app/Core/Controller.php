<?php
class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require_once "app/Views/$view.php";
    }
    
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }
    
    protected function requireRole($role) {
        $this->requireAuth();
        if ($_SESSION['user_role'] != $role) {
            http_response_code(403);
            echo "Access Denied";
            exit;
        }
    }
}
?>