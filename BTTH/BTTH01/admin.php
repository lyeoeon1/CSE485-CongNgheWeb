<?php
// Mảng chứa thông tin các loài hoa (giống flowers.php)
$flowers = [
    ["name" => "Đổ Quyên", "description" => "Dạ yên thảo là lựa chọn phổ biến cho những ai yêu thích trồng hoa làm đẹp không gian sống. Hoa có màu sắc đa dạng, phù hợp với khí hậu Việt Nam.", "image" => "doquyen.jpg"],
    ["name" => "Hải Dương", "description" => "Hoa đèn lòng có hình dạng độc đáo như chiếc đèn lồng nhỏ, thường có màu đỏ cam rực rỡ, mang lại may mắn.", "image" => "haiduong.jpg"],
    ["name" => "Mai", "description" => "Hoa cúc lá nho với những bông hoa nhiều màu sắc, tươi tắn, dễ trồng, thích hợp với mọi thời tiết.", "image" => "mai.jpg"],
    ["name" => "Tường Vy", "description" => "Hoa thanh tú có màu tím nhạt đến tím đậm, mọc thành từng chùm, tạo cảnh quan lãng mạn cho khu vườn.", "image" => "tuongvy.jpg"],
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Các Loại Hoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .link {
            text-align: center;
            margin-bottom: 20px;
        }
        .link a {
            background-color: #198754;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background-color: #0d6efd;
            color: white;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        table img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh Sách Các Loại Hoa</h1>
        
        <div class="link">
            <a href="flowers.php">Xem dạng bài viết (Người dùng)</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Ảnh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $flower['name']; ?></td>
                        <td><?php echo $flower['description']; ?></td>
                        <td><img src="images/<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>