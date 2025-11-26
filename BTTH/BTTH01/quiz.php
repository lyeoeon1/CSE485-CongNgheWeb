<?php
/**
 * PHẦN 1: LOGIC PHP - ĐỌC VÀ XỬ LÝ DỮ LIỆU TỪ TỆP TIN
 * Mục đích: Chuyển nội dung text thô từ Quiz.txt thành một MẢNG PHP có cấu trúc
 */

$file_name = "Quiz.txt";
$quiz_data = [];

// 1. Kiểm tra sự tồn tại của tệp tin
if (!file_exists($file_name)) {
    // Dừng chương trình nếu không tìm thấy tệp
    die("Lỗi: Tệp tin <b>$file_name</b> không được tìm thấy! Vui lòng kiểm tra lại thư mục.");
}

// 2. Đọc toàn bộ nội dung tệp
$file_content = file_get_contents($file_name);
$file_content = trim($file_content); // Loại bỏ khoảng trắng/xuống dòng ở đầu và cuối

// 3. Tách nội dung thành các khối câu hỏi (ngăn cách bởi 2 ký tự xuống dòng \n\n)
$question_blocks = explode("\n\n", $file_content);

// 4. Duyệt qua từng khối để trích xuất dữ liệu chi tiết
foreach ($question_blocks as $block) {
    $block = trim($block);
    
    // Nếu khối không rỗng, tiến hành xử lý
    if (!empty($block)) {
        // Tách khối câu hỏi thành các dòng riêng biệt (ngăn cách bởi 1 ký tự xuống dòng \n)
        $lines = explode("\n", $block);
        
        // Kiểm tra xem có đủ các dòng (Câu hỏi + 4 Đáp án + Đáp án đúng) không
        if (count($lines) >= 6) {
            $question_text = $lines[0];
            // Lấy 4 dòng tiếp theo làm các lựa chọn (A, B, C, D)
            $options = array_slice($lines, 1, 4); 
            
            $answer_line = $lines[5];
            
            // Xử lý để lấy ra chữ cái đáp án đúng (ví dụ: từ "ANSWER: C" chỉ lấy "C")
            $correct_answer = trim(str_replace("ANSWER:", "", $answer_line));

            // Thêm dữ liệu câu hỏi đã cấu trúc vào mảng $quiz_data
            $quiz_data[] = [
                'question' => $question_text,
                'options' => $options,
                'answer' => $correct_answer
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm Đọc Tệp - PHP</title>
    <style>
        /* CSS đơn giản để làm trang web dễ nhìn hơn */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #e9ecef;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .question-block {
            border: 1px solid #dee2e6;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .question-text {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 15px;
            color: #343a40;
        }
        .option {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        .option label {
            margin-left: 10px;
            cursor: pointer;
            font-size: 1em;
            color: #495057;
        }
        input[type="radio"] {
            transform: scale(1.2); /* Phóng to nút radio */
        }
        .submit-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .submit-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📝 Bài Thi Trắc Nghiệm Đọc Dữ Liệu</h1>
    
    <form action="index.php" method="POST">
    
    <?php
    /**
     * PHẦN 2: HIỂN THỊ HTML - SỬ DỤNG DỮ LIỆU ĐÃ XỬ LÝ
     */

    $question_number = 1;
    // Bắt đầu vòng lặp để duyệt qua từng câu hỏi trong mảng $quiz_data
    foreach ($quiz_data as $quiz) {
        
        echo '<div class="question-block">';
        
        // In ra nội dung câu hỏi
        echo '<div class="question-text">Câu ' . $question_number . ': ' . htmlspecialchars($quiz['question']) . '</div>';
        
        // In ra các đáp án
        foreach ($quiz['options'] as $option_line) {
            // Lấy chữ cái đáp án (A, B, C, D)
            $option_letter = substr($option_line, 0, 1);
            
            // Tên của input group là "q" + số thứ tự để đảm bảo chỉ chọn 1 đáp án/câu
            $input_name = 'q' . $question_number;
            $input_id = $input_name . '_' . $option_letter;
            
            echo '<div class="option">';
            // input type="radio": Tạo nút tròn. value là chữ cái đáp án A, B, C, D
            echo '<input type="radio" id="' . $input_id . '" name="' . $input_name . '" value="' . $option_letter . '">';
            echo '<label for="' . $input_id . '">' . htmlspecialchars($option_line) . '</label>';
            echo '</div>'; // Kết thúc div.option
        }
        
        echo '</div>'; // Kết thúc div.question-block
        
        $question_number++;
    }
    ?>
    
    <button type="submit" class="submit-button">Nộp bài (Chức năng chấm điểm chưa được lập trình)</button>
    
    </form>

</div>

</body>
</html>