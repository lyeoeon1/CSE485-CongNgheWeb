<?php
// Tệp Model chứa tất cả logic truy vấn CSDL

// TODO 1: Hàm getAllSinhVien()
function getAllSinhVien($pdo) {
    $sql = "SELECT * FROM sinhvien ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// TODO 2: Hàm addSinhVien()
function addSinhVien($pdo, $ten, $email) {
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]);
}
?>
