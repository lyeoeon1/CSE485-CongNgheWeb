-- Online Course Management System Database
-- Created for BTTH2 - CSE485

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create database
CREATE DATABASE IF NOT EXISTS `onlinecourse` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `onlinecourse`;

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0 COMMENT '0: học viên, 1: giảng viên, 2: quản trị viên',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `categories`
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `courses`
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration_weeks` int(11) NOT NULL DEFAULT 1,
  `level` varchar(50) NOT NULL DEFAULT 'Beginner',
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `instructor_id` (`instructor_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `enrollments`
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `enrolled_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `progress` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_enrollment` (`course_id`, `student_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `lessons`
CREATE TABLE `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext,
  `video_url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Table structure for table `materials`
CREATE TABLE `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

-- Insert sample data

-- Insert categories
INSERT INTO `categories` (`name`, `description`) VALUES
('Lập trình Web', 'Các khóa học về phát triển website và ứng dụng web'),
('Mobile Development', 'Phát triển ứng dụng di động cho iOS và Android'),
('Data Science', 'Khoa học dữ liệu và phân tích dữ liệu'),
('Machine Learning', 'Học máy và trí tuệ nhân tạo'),
('DevOps', 'Vận hành và triển khai hệ thống'),
('UI/UX Design', 'Thiết kế giao diện và trải nghiệm người dùng'),
('Database', 'Cơ sở dữ liệu và quản lý dữ liệu'),
('Network Security', 'Bảo mật mạng và an ninh thông tin');

-- Insert sample users
INSERT INTO `users` (`username`, `email`, `password`, `fullname`, `role`) VALUES
('admin', 'admin@onlinecourse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Quản trị viên', 2),
('instructor1', 'instructor1@onlinecourse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Văn A', 1),
('instructor2', 'instructor2@onlinecourse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Thị B', 1),
('student1', 'student1@onlinecourse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Văn C', 0),
('student2', 'student2@onlinecourse.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Thị D', 0);

-- Insert sample courses
INSERT INTO `courses` (`title`, `description`, `instructor_id`, `category_id`, `price`, `duration_weeks`, `level`) VALUES
('PHP & MySQL từ cơ bản đến nâng cao', 'Khóa học toàn diện về lập trình PHP và MySQL, từ những kiến thức cơ bản đến các kỹ thuật nâng cao. Học viên sẽ được thực hành xây dựng các ứng dụng web thực tế.', 2, 1, 1500000, 12, 'Beginner'),
('Xây dựng ứng dụng React Native', 'Học cách phát triển ứng dụng di động đa nền tảng với React Native. Khóa học bao gồm các kiến thức từ cơ bản đến nâng cao về React Native.', 2, 2, 2000000, 10, 'Intermediate'),
('Python cho Data Science', 'Khóa học Python chuyên sâu cho lĩnh vực khoa học dữ liệu. Học viên sẽ làm quen với các thư viện như Pandas, NumPy, Matplotlib và Scikit-learn.', 3, 3, 1800000, 8, 'Intermediate'),
('Machine Learning cơ bản', 'Giới thiệu về học máy và các thuật toán cơ bản. Khóa học phù hợp cho người mới bắt đầu với Machine Learning.', 3, 4, 2500000, 14, 'Beginner'),
('UI/UX Design với Figma', 'Học thiết kế giao diện và trải nghiệm người dùng sử dụng công cụ Figma. Từ wireframe đến prototype hoàn chỉnh.', 2, 6, 1200000, 6, 'Beginner'),
('Docker và Kubernetes', 'Khóa học về containerization và orchestration với Docker và Kubernetes. Phù hợp cho DevOps engineers.', 3, 5, 2200000, 10, 'Advanced');

-- Insert sample enrollments
INSERT INTO `enrollments` (`course_id`, `student_id`, `status`, `progress`) VALUES
(1, 4, 'active', 45),
(2, 4, 'active', 20),
(3, 5, 'completed', 100),
(1, 5, 'active', 75),
(4, 4, 'active', 10);

-- Insert sample lessons
INSERT INTO `lessons` (`course_id`, `title`, `content`, `order`) VALUES
(1, 'Giới thiệu về PHP', 'Bài học đầu tiên giới thiệu về ngôn ngữ lập trình PHP, lịch sử phát triển và ứng dụng.', 1),
(1, 'Cài đặt môi trường phát triển', 'Hướng dẫn cài đặt XAMPP, thiết lập môi trường phát triển PHP.', 2),
(1, 'Cú pháp cơ bản PHP', 'Học về cú pháp cơ bản của PHP: biến, hằng, toán tử, cấu trúc điều khiển.', 3),
(2, 'Giới thiệu React Native', 'Tổng quan về React Native và so sánh với các framework khác.', 1),
(2, 'Cài đặt và thiết lập', 'Hướng dẫn cài đặt React Native CLI và thiết lập dự án đầu tiên.', 2),
(3, 'Python cơ bản cho Data Science', 'Ôn tập Python cơ bản và các thư viện cần thiết cho Data Science.', 1),
(3, 'Pandas và NumPy', 'Học cách sử dụng Pandas và NumPy để xử lý dữ liệu.', 2);

COMMIT;

-- Note: Default password for all sample users is 'password'
-- In production, make sure to use strong passwords and proper hashing