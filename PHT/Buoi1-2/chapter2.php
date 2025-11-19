<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHT Chương 2 - PHP Căn Bản</title>
</head>
<body>
    <h1>Kết quả PHP Căn Bản</h1>
    <?php
    // TODO 1: Khai báo 3 biến
    $ho_ten = "Tống Thèn Hùng";
    $diem_tb = 8.7;
    $co_di_hoc_chuyen_can = true;
    
    // TODO 2: In ra thông tin sinh viên
    echo "Họ và tên: $ho_ten<br>";
    echo "Điểm trung bình: $diem_tb<br><br>";
    
    // TODO 3: Viết cấu trúc IF/ELSE IF/ELSE
    echo "Xếp loại: ";
    if ($diem_tb >= 8.5 && $co_di_hoc_chuyen_can == true) {
        echo "Giỏi<br>";
    } elseif ($diem_tb >= 6.5 && $co_di_hoc_chuyen_can == true) {
        echo "Khá<br>";
    } elseif ($diem_tb >= 5.0 && $co_di_hoc_chuyen_can == true) {
        echo "Trung bình<br>";
    } else {
        echo "Yếu (Cần cố gắng thêm!)<br>";
    }
    
    echo "<br>";
    
    // TODO 4: Viết 1 hàm đơn giản
    function chaoMung() {
        echo "Chúc mừng bạn đã hoàn thành PHT Chương 2!";
    }

    // TODO 5: Gọi hàm
    chaoMung();
    ?>
</body>
</html>
