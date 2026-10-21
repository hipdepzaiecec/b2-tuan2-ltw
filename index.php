<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kiểm tra điểm hợp lệ</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; background: #f9f9f9; }
        .valid { color: green; font-weight: bold; }
        .invalid { color: red; font-weight: bold; }
        
        

        .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
    </style>
</head>
<body>
    <a href="index.php"><button class="nut">Bài 2 </button></a>
    <a href="b2_3.php"><button class="nut">Bài 2.3</button></a>
    <a href="b2_4.php"><button class="nut">Bài 2.4</button></a>
    <a href="b2_5.php"><button class="nut">Bài 2.5</button></a>
    <a href="b2_6.php"><button class="nut">Bài 2.6</button></a>
    <a href="b2_7.php"><button class="nut">Bài 2.7</button></a>
    <a href="b2_8.php"><button class="nut">Bài 2.8</button></a>
    <a href="b2_9.php"><button class="nut">Bài 2.9</button></a>
    <a href="b3_6.php"><button class="nut">Bài 3.6</button></a>
    <a href="b3_7_1.php"><button class="nut">Bài 3.7</button></a>
    <a href="b3_8.php"><button class="nut">Bài 3.8</button></a>
    <h2>Bài 2 nhập điểm kiểm tra</h2>
    
    <!-- Form gửi dữ liệu bằng phương thức POST -->
    <form method="POST" action="">
        <label for="score">Nhập điểm (0 - 10): </label>
        <input type="text" name="score" id="score" required>
        <button type="submit" name="submit">Kiểm tra</button>
    </form>

    <?php
    // Bước 1: Định nghĩa hàm kiểm tra điểm hợp lệ
    // Hàm nhận vào 1 tham số và trả về true/false
    function isValidScore($score) {
        // Ép kiểu về số thực (float) để so sánh chính xác
        $score = (float)$score;

        // Sử dụng toán tử so sánh >= và <= kết hợp toán tử logic &&
        // Điều kiện: Điểm phải lớn hơn hoặc bằng 0 VÀ nhỏ hơn hoặc bằng 10
        if ($score >= 0 && $score <= 10) {
            return true;
        } else {
            return false;
        }
    }

    // Bước 2: Xử lý dữ liệu khi người dùng nhấn nút Submit
    if (isset($_POST['submit'])) {
        // Lấy dữ liệu từ POST
        $inputScore = $_POST['score'];
        
        // Kiểm tra xem người dùng có nhập số không (để tránh lỗi)
        if (is_numeric($inputScore)) {
            // Gọi hàm kiểm tra
            $check = isValidScore($inputScore);

            echo "<div class='result'>";
            echo "Điểm bạn nhập: <strong>" . htmlspecialchars($inputScore) . "</strong><br>";

            if ($check) {
                echo "<span class='valid'>=> Điểm hợp lệ (Nằm trong khoảng 0 đến 10).</span>";
            } else {
                echo "<span class='invalid'>=> Điểm KHÔNG hợp lệ (Phải nằm trong khoảng 0 đến 10).</span>";
            }
            echo "</div>";
        } else {
            echo "<div class='result invalid'>Vui lòng nhập một số!</div>";
        }
    }
    ?>

<footer>
    <p>Pham Văn Hiệp - TUD2024 - 224001717</p>
</footer>
</body>


</html>