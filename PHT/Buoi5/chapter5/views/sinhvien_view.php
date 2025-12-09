<?php
// Tệp View CHỈ chứa HTML và logic hiển thị
// KHÔNG chứa câu lệnh SQL
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHT Chương 5 - MVC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        input[type="text"], input[type="email"] {
            width: 300px;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e8f5e9;
        }
    </style>
</head>
<body>
    <h2>Thêm Sinh Viên Mới (Kiến trúc MVC)</h2>
    
    <form method="POST" action="index.php">
        <label for="ten_sinh_vien">Tên sinh viên:</label><br>
        <input type="text" id="ten_sinh_vien" name="ten_sinh_vien" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <input type="submit" value="Thêm Sinh Viên">
    </form>

    <h2>Danh Sách Sinh Viên (Kiến trúc MVC)</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Tên Sinh Viên</th>
            <th>Email</th>
            <th>Ngày Tạo</th>
        </tr>
        
        <?php
        // TODO 4: Dùng vòng lặp foreach để duyệt qua biến $danh_sach_sv
        foreach ($danh_sach_sv as $sv) {
            // TODO 5: In các dòng <tr> và <td> chứa dữ liệu
            echo "<tr>";
            echo "<td>" . htmlspecialchars($sv['id']) . "</td>";
            echo "<td>" . htmlspecialchars($sv['ten_sinh_vien']) . "</td>";
            echo "<td>" . htmlspecialchars($sv['email']) . "</td>";
            echo "<td>" . htmlspecialchars($sv['ngay_tao']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
