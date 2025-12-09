<?php
// Tệp Controller là "não" của ứng dụng

// TODO 6: Import tệp Model
require_once 'models/SinhVienModel.php';

// === THIẾT LẬP KẾT NỐI PDO ===
// TODO 7: Copy code PDO từ PHT Chương 4
$host = '127.0.0.1';
$dbname = 'cse485_web';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
// === KẾT THÚC KẾT NỐI PDO ===

// === LOGIC CỦA CONTROLLER ===

// TODO 8: Kiểm tra xem có hành động POST (thêm sinh viên) không
if (isset($_POST['ten_sinh_vien']) && isset($_POST['email'])) {
    // TODO 9: Lấy $ten và $email từ $_POST
    $ten = $_POST['ten_sinh_vien'];
    $email = $_POST['email'];
    
    // TODO 10: Gọi hàm addSinhVien() từ Model
    addSinhVien($pdo, $ten, $email);
    
    // TODO 11: Chuyển hướng về index.php để "làm mới" trang
    header('Location: index.php');
    exit;
}

// TODO 12: Gọi hàm getAllSinhVien() từ Model
$danh_sach_sv = getAllSinhVien($pdo);

// TODO 13: Import tệp View ở cuối cùng
include 'views/sinhvien_view.php';
?>
