<?php
// === THIẾT LẬP KẾT NỐI PDO ===
$host = '127.0.0.1'; // hoặc localhost
$dbname = 'cse485_web'; // Tên CSDL bạn vừa tạo
$username = 'root'; // Username mặc định của XAMPP
$password = ''; // Password mặc định của XAMPP (rỗng)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // TODO 1: Tạo đối tượng PDO để kết nối CSDL
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Kết nối thành công!"; // (Bỏ comment để test)
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// === LOGIC THÊM SINH VIÊN (XỬ LÝ FORM POST) ===
// TODO 2: Kiểm tra xem form đã được gửi đi (method POST) và có 'ten_sinh_vien' không
if (isset($_POST['ten_sinh_vien']) && isset($_POST['email'])) {
    // TODO 3: Lấy dữ liệu 'ten_sinh_vien' và 'email' từ $_POST
    $ten = $_POST['ten_sinh_vien'];
    $email = $_POST['email'];
    
    // TODO 4: Viết câu lệnh SQL INSERT với Prepared Statement (dùng dấu ?)
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)";
    
    // TODO 5: Chuẩn bị (prepare) và thực thi (execute) câu lệnh
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]);
    
    // TODO 6: (Tùy chọn) Chuyển hướng về chính trang này để "làm mới"
    header('Location: chapter4.php');
    exit;
}

// === LOGIC LẤY DANH SÁCH SINH VIÊN (SELECT) ===
// TODO 7: Viết câu lệnh SQL SELECT *
$sql_select = "SELECT * FROM sinhvien ORDER BY id ASC";

// TODO 8: Thực thi câu lệnh SELECT (không cần prepare vì không có tham số)
$stmt_select = $pdo->query($sql_select);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHT Chương 4 - Website hướng dữ liệu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            padding: 0;
        }
        
        .header {
            background-color: #1e3a8a;
            color: white;
            padding: 20px 0;
            border-bottom: 4px solid #c9a227;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .header h1 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .header p {
            font-size: 13px;
            margin-top: 5px;
            opacity: 0.9;
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .card {
            background: white;
            border: 1px solid #d1d5db;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            color: #1e3a8a;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
            border-left: 4px solid #c9a227;
            padding-left: 12px;
            text-transform: uppercase;
        }
        
        form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        label {
            display: block;
            margin-bottom: 6px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            font-family: Arial, sans-serif;
            transition: border-color 0.2s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #1e3a8a;
        }
        
        button {
            background-color: #1e3a8a;
            color: white;
            padding: 10px 24px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        button:hover {
            background-color: #1e40af;
        }
        
        button:active {
            background-color: #1e3a8a;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border: 1px solid #d1d5db;
        }
        
        thead {
            background-color: #f9fafb;
        }
        
        th {
            background-color: #1e3a8a;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #1e3a8a;
        }
        
        td {
            padding: 12px;
            border: 1px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        tbody tr:hover {
            background-color: #f3f4f6;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            font-style: italic;
            border: 1px dashed #d1d5db;
            background-color: #f9fafb;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 13px;
            margin-top: 40px;
            border-top: 1px solid #e5e7eb;
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 18px;
            }
            
            .card {
                padding: 15px;
            }
            
            form {
                grid-template-columns: 1fr;
            }
            
            button {
                width: 100%;
            }
            
            table {
                font-size: 12px;
            }
            
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Hệ Thống Quản Lý Sinh Viên</h1>
            <p>Phòng Đào Tạo - Trường Đại Học Thuỷ Lợi</p>
        </div>
    </div>
    
    <div class="container">
        <div class="card">
            <h2>Thêm Sinh Viên Mới</h2>
            <form action="chapter4.php" method="POST">
                <div class="form-group">
                    <label for="ten_sinh_vien">Họ và tên sinh viên <span style="color: #dc2626;">*</span></label>
                    <input type="text" id="ten_sinh_vien" name="ten_sinh_vien" required>
                </div>
                <div class="form-group">
                    <label for="email">Địa chỉ Email <span style="color: #dc2626;">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit">Thêm Mới</button>
            </form>
        </div>

        <div class="card">
            <h2>Danh Sách Sinh Viên</h2>
            <?php if ($stmt_select->rowCount() > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px;">Mã SV</th>
                        <th>Họ và Tên</th>
                        <th>Email</th>
                        <th style="width: 180px;">Ngày Đăng Ký</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // TODO 9: Dùng vòng lặp (ví dụ: while) để duyệt qua kết quả $stmt_select
                    while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
                        // TODO 10: In (echo) các dòng <tr> và <td> chứa dữ liệu $row
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ten_sinh_vien']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ngay_tao']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="empty-state">
                Hiện tại chưa có dữ liệu sinh viên trong hệ thống.
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="footer">
        © 2024 Hệ Thống Quản Lý Sinh Viên - Phiên bản 1.0
    </div>
</body>
</html>
