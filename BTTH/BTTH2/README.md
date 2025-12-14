# Website Quản Lý Khóa Học Online

Đây là dự án website quản lý khóa học online được xây dựng bằng PHP & MySQL theo mô hình MVC OOP, thực hiện cho bài tập thực hành số 02 - CSE485.

## Tính năng chính

### Dành cho Học viên (Student)
- Xem danh sách khóa học với tìm kiếm và lọc theo danh mục
- Xem chi tiết khóa học
- Đăng ký khóa học
- Xem khóa học đã đăng ký
- Theo dõi tiến độ học tập
- Dashboard cá nhân

### Dành cho Giảng viên (Instructor)
- Đăng nhập/đăng xuất
- Tạo, chỉnh sửa, xóa khóa học
- Quản lý khóa học của mình
- Dashboard giảng viên
- Xem danh sách học viên đã đăng ký (tính năng mở rộng)

### Tính năng chung
- Hệ thống đăng ký/đăng nhập an toàn
- Phân quyền người dùng (Student, Instructor, Admin)

## Công nghệ sử dụng

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Architecture**: MVC (Model-View-Controller)

## Cấu trúc thư mục

```
onlinecourse/
├── app/
│   ├── Controllers/          # Các controller xử lý logic
│   ├── Models/              # Các model tương tác với database
│   ├── Views/               # Các view hiển thị giao diện
│   └── Core/                # Các class core (Router, Controller)
├── config/                  # File cấu hình
├── database/               # File SQL tạo database
├── public/                 # File tĩnh (CSS, JS, images)
│   └── assets/
├── .htaccess              # URL rewriting
├── index.php              # Entry point
└── README.md
```

## Cài đặt

### Yêu cầu hệ thống
- PHP 7.4 trở lên
- MySQL 5.7 trở lên
- Apache/Nginx với mod_rewrite
- XAMPP/WAMP/LAMP (khuyến nghị)

## Sử dụng

### Truy cập website
- URL: `http://localhost/cse485/BTTH2`

### Tài khoản mẫu
Hệ thống đã tạo sẵn các tài khoản mẫu (mật khẩu: `password`):

**Giảng viên:**
- Email: instructor1@onlinecourse.com
- Email: instructor2@onlinecourse.com
- Mật khẩu: password

**Học viên:**
- Email: student1@onlinecourse.com
- Email: student2@onlinecourse.com
- Mật khẩu: password

### Luồng sử dụng cơ bản

1. **Đăng ký tài khoản mới** (nếu cần)
   - Truy cập `/register`
   - Chọn vai trò: Học viên hoặc Giảng viên

2. **Đăng nhập**
   - Truy cập `/login`
   - Nhập email và mật khẩu

3. **Dành cho Học viên:**
   - Xem danh sách khóa học tại `/courses`
   - Tìm kiếm và lọc khóa học
   - Xem chi tiết và đăng ký khóa học
   - Theo dõi tiến độ tại Dashboard

4. **Dành cho Giảng viên:**
   - Truy cập Dashboard giảng viên
   - Tạo khóa học mới
   - Quản lý khóa học đã tạo

## Tính năng có thể mở rộng

- Upload hình ảnh cho khóa học
- Quản lý bài học và tài liệu
- Hệ thống đánh giá khóa học
- Thanh toán online
- Thông báo và email
- API REST
- Admin panel hoàn chỉnh