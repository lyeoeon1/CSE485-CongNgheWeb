<?php
// Đọc file CSV
$filename = "SINHVIEN.csv";
$sinhvien = [];

if (file_exists($filename)) {
    $file = fopen($filename, "r");
    
    // Đọc dòng đầu tiên (header)
    $headers = fgetcsv($file);
    
    // Đọc các dòng tiếp theo
    while (($data = fgetcsv($file)) !== FALSE) {
        $sinhvien[] = $data;
    }
    
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
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
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>DANH SÁCH SINH VIÊN</h1>
        
        <table>
            <thead>
                <tr>
                    <?php foreach ($headers as $header): ?>
                        <th><?php echo $header; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sinhvien as $sv): ?>
                    <tr>
                        <?php foreach ($sv as $value): ?>
                            <td><?php echo $value; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <p style="margin-top: 20px; color: #666;">
            Tổng số: <strong><?php echo count($sinhvien); ?></strong> sinh viên
        </p>
    </div>
</body>
</html>