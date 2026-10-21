<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Máy tính điểm học phần</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .container {  }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: inline-block; width: 180px; font-weight: bold; }
        input[type="text"], input[type="number"] { padding: 5px; width: 200px; }
       .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
        
        .result { margin-top: 20px; padding: 15px;  }
        .error { margin-top: 20px; padding: 15px; background-color: #ffebee; border-left: 5px solid #f44336; color: red; }
        
        .giong { color: green; font-weight: bold; }
        .kha { color: blue; font-weight: bold; }
        .tb { color: orange; font-weight: bold; }
        .yeu { color: red; font-weight: bold; }
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
    <div class="container">
        <h2>Bài 2.9 máy tính điểm học phần </h2>
        
        <!-- Form nhập liệu -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="cc">Điểm chuyên cần (10%):</label>
                <input type="number" step="0.1" name="cc" id="cc" required>
            </div>
            <div class="form-group">
                <label for="mid">Điểm giữa kỳ (30%):</label>
                <input type="number" step="0.1" name="mid" id="mid" required>
            </div>
            <div class="form-group">
                <label for="final">Điểm cuối kỳ (60%):</label>
                <input type="number" step="0.1" name="final" id="final" required>
            </div>
            <button type="submit" name="submit">Tính Điểm</button>
        </form>

        <?php
        // --- HƯỚNG DẪN BƯỚC 2: VIẾT CÁC HÀM ---

        // Hàm 1: Kiểm tra điểm có hợp lệ không (từ 0 đến 10)
        function isValidScore($score) {
            // Ép kiểu float để đảm bảo tính toán chính xác
            $score = (float)$score;
            // Trả về true nếu >= 0 VÀ <= 10, ngược lại trả về false
            return ($score >= 0 && $score <= 10);
        }

        // Hàm 2: Tính điểm tổng kết theo công thức
        function finalScore(float $cc, float $mid, float $final): float {
            $tongKet = $cc * 0.10 + $mid * 0.30 + $final * 0.60;
            return round($tongKet, 2); // Làm tròn 2 chữ số thập phân
        }

        // --- XỬ LÝ KHI NGƯỜI DÙNG NHẤN NÚT ---
        if (isset($_POST['submit'])) {
            // BƯỚC 3: Dùng POST để lấy dữ liệu
            $ten = $_POST['name'] ?? '';
            $diemCC = $_POST['cc'] ?? '';
            $diemMid = $_POST['mid'] ?? '';
            $diemFinal = $_POST['final'] ?? '';

            // BƯỚC 4: Giữ lại dữ liệu đã nhập khi có lỗi (in lại value vào form)
            // (Phần này tôi sẽ xử lý bằng cách in trực tiếp vào các thẻ input bên trên, nhưng để đơn giản, ta chỉ hiển thị ở phần kết quả).

            // Kiểm tra dữ liệu đầu vào (Yêu cầu: Hiển thị lỗi nếu điểm không nằm trong khoảng 0-10)
            // Kiểm tra xem người dùng có nhập chữ vào ô điểm không (dùng is_numeric)
            if (!is_numeric($diemCC) || !is_numeric($diemMid) || !is_numeric($diemFinal)) {
                echo "<div class='error'>Lỗi: Điểm phải là số!</div>";
            } 
            // Gọi hàm isValidScore để kiểm tra khoảng 0-10
            elseif (!isValidScore($diemCC) || !isValidScore($diemMid) || !isValidScore($diemFinal)) {
                echo "<div class='error'>Lỗi: Điểm phải nằm trong khoảng từ 0 đến 10!</div>";
            } 
            else {
                // Nếu dữ liệu hợp lệ, tiến hành tính toán
                $diemTongKet = finalScore((float)$diemCC, (float)$diemMid, (float)$diemFinal);

                // Xếp loại (Dùng if/elseif/else, xếp từ cao xuống thấp)
                if ($diemTongKet >= 8) {
                    $xepLoai = "<span class='giong'>Giỏi</span>";
                } elseif ($diemTongKet >= 6.5) {
                    $xepLoai = "<span class='kha'>Khá</span>";
                } elseif ($diemTongKet >= 5) {
                    $xepLoai = "<span class='tb'>Trung bình</span>";
                } else {
                    $xepLoai = "<span class='yeu'>Chưa đạt</span>";
                }

                // Hiển thị kết quả
                echo "<div class='result'>";
                echo "<h3>Kết quả của: " . htmlspecialchars($ten) . "</h3>";
                echo "Điểm chuyên cần: $diemCC <br>";
                echo "Điểm giữa kỳ: $diemMid <br>";
                echo "Điểm cuối kỳ: $diemFinal <br>";
                
                echo "<strong>Điểm tổng kết: <span style='font-size: 20px; color: red;'>$diemTongKet</span></strong> <br>";
                echo "<strong>Xếp loại: $xepLoai</strong>";
                echo "</div>";
            }
        }
        ?>

    </div>

</body>
</html>