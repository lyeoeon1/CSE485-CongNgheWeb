<?php
// db_config.php

// Thiết lập thông tin kết nối
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');   // Thay bằng username của bạn
define('DB_PASSWORD', '');       // Thay bằng password của bạn
define('DB_NAME', 'web_tlu');    // Tên CSDL đã tạo

// Tạo kết nối
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// **QUAN TRỌNG:** Thiết lập mã hóa UTF-8mb4 cho kết nối (khắc phục lỗi tiếng Việt)
$conn->set_charset("utf8mb4");

// Hàm hỗ trợ lấy dữ liệu từ CSDL
function get_db_data($sql) {
    global $conn;
    $result = $conn->query($sql);
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}
?>