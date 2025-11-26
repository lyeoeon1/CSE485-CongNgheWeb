CREATE DATABASE IF NOT EXISTS web_tlu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE web_tlu;

-- Bảng: Dữ liệu Hoa (flowers)
CREATE TABLE IF NOT EXISTS flowers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_hoa VARCHAR(255) NOT NULL,
    mo_ta TEXT,
    anh VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm dữ liệu mẫu ban đầu
INSERT INTO flowers (ten_hoa, mo_ta, anh) VALUES 
('Đỗ Quyên', 'Nữ hoàng của các loài hoa, tượng trưng cho tình yêu.', 'doquyen.jpg'),
('Mai', 'Quốc hoa của Việt Nam, biểu tượng của sự thanh khiết.', 'mai.jpg'),
('Tường Vy', 'Luôn hướng về phía mặt trời, tượng trưng cho niềm tin.', 'tuongvy.jpg');
('Hải Đường', 'Luôn hướng về phía mặt trời, tượng trưng cho niềm tin.', 'haiduong.jpg');