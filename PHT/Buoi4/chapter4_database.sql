-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS cse485_web 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Sử dụng cơ sở dữ liệu
USE cse485_web;

-- Tạo bảng sinh viên
CREATE TABLE sinhvien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_sinh_vien VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);