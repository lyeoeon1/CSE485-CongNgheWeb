<?php
// Mảng chứa thông tin các loài hoa
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
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .flower {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .flower img {
            width: 100%;
            max-width: 500px;
            height: auto;
            display: block;
            margin: 0 auto 15px;
        }
        .flower h2 {
            color: #d63384;
            margin-bottom: 10px;
        }
        .flower p {
            line-height: 1.6;
            color: #666;
        }
        .link {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .link a {
            background-color: #0d6efd;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh Sách Các Loại Hoa</h1>
        
        <div class="link">
            <a href="admin.php">Xem dạng bảng (Quản trị)</a>
        </div>

        <?php foreach ($flowers as $flower): ?>
            <div class="flower">
                <h2><?php echo $flower['name']; ?></h2>
                <p><?php echo $flower['description']; ?></p>
                <img src="images/<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
