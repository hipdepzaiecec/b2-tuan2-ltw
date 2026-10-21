<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tính điểm tổng kết</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: inline-block; width: 150px; }
        input[type="number"] { width: 100px; padding: 5px; }
        
        .result { margin-top: 20px; padding: 15px; }
        .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
    </style>
</head>
<body>

    <div class="container">
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
        <h2>Bài 2.5 nhập điểm môn học</h2>
        
        <!-- Form gửi dữ liệu -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="cc">Điểm chuyên cần (10%):</label>
                <input type="number" step="0.1" min="0" max="10" name="cc" id="cc" required>
            </div>
            <div class="form-group">
                <label for="mid">Điểm giữa kỳ (30%):</label>
                <input type="number" step="0.1" min="0" max="10" name="mid" id="mid" required>
            </div>
            <div class="form-group">
                <label for="final">Điểm cuối kỳ (60%):</label>
                <input type="number" step="0.1" min="0" max="10" name="final" id="final" required>
            </div>
            
            <button type="submit" name="submit">Tính điểm tổng kết</button>
        </form>

        <?php
        // 1. Hàm tính điểm (giữ nguyên từ bài trước)
        function finalScore(float $cc, float $mid, float $final): float 
        {
            $tongKet = $cc * 0.10 + $mid * 0.30 + $final * 0.60;
            return round($tongKet, 2); // Làm tròn 2 chữ số thập phân
        }

        // 2. Xử lý khi người dùng nhấn nút
        if (isset($_POST['submit'])) {
            // Lấy dữ liệu từ form (Ép kiểu float để an toàn)
            $diemCC = (float)$_POST['cc'];
            $diemGiuaKy = (float)$_POST['mid'];
            $diemCuoiKy = (float)$_POST['final'];

            // Gọi hàm tính toán
            $ketQua = finalScore($diemCC, $diemGiuaKy, $diemCuoiKy);

            // Hiển thị kết quả
            echo "<div class='result'>";
            echo "<h3>Kết quả:</h3>";
            echo "Điểm chuyên cần: <strong>$diemCC</strong><br>";
            echo "Điểm giữa kỳ: <strong>$diemGiuaKy</strong><br>";
            echo "Điểm cuối kỳ: <strong>$diemCuoiKy</strong><br><br>";
            
            echo "<strong>Điểm tổng kết: <span style='color:red; font-size: 20px;'>" . $ketQua . "</span></strong>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>