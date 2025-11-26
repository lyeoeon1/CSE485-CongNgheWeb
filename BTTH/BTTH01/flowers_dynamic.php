<?php
require_once 'db_config.php';

// Lấy dữ liệu hoa từ CSDL 
$flowers = get_db_data("SELECT * FROM flowers ORDER BY ten_hoa ASC");

$is_admin = true; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Các Loài Hoa Dữ liệu Động từ CSDL</title>
    <style>
        .flower-card { border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; width: 300px; display: inline-block; vertical-align: top; }
        .flower-card img { width: 100%; height: auto; margin-bottom: 10px; }
        table { width: 80%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Danh Sách Các Loài Hoa (Dữ liệu động)</h2>

    <?php if ($is_admin): ?>
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><img src="images/<?php echo htmlspecialchars($flower['anh']); ?>" alt="<?php echo htmlspecialchars($flower['ten_hoa']); ?>" width="50"></td>
                    <td><?php echo htmlspecialchars($flower['ten_hoa']); ?></td>
                    <td><?php echo htmlspecialchars($flower['mo_ta']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <h3>🌸 Giao diện Khách (Dạng List/Card)</h3>
        <?php foreach ($flowers as $flower): ?>
            <div class="flower-card">
                <img src="images/<?php echo htmlspecialchars($flower['anh']); ?>" alt="<?php echo htmlspecialchars($flower['ten_hoa']); ?>">
                <h4><?php echo htmlspecialchars($flower['ten_hoa']); ?></h4>
                <p><?php echo htmlspecialchars($flower['mo_ta']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>