<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; background: #f9f9f9; font-size: 18px;}
        .giong { color: green; font-weight: bold; } /* Giỏi */
        .kha { color: blue; font-weight: bold; }    /* Khá */
        .tb { color: orange; font-weight: bold; }   /* Trung bình */
        .yeu { color: red; font-weight: bold; }     /* Chưa đạt */
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
    <h2>Bài 2.3 kiểm tra xếp loại điểm</h2>
    
    <form method="POST" action="">
        <label for="score">Nhập điểm của bạn: </label>
        <input type="number" step="0.1" name="score" id="score" required>
        <button type="submit" name="submit">Xếp loại</button>
    </form>

    <?php
    // Hàm xếp loại điểm
    function xepLoaiDiem($diem) {
        // Bước 1: Kiểm tra dữ liệu đầu vào (như kiến thức cốt lõi đã dặn)
        if ($diem < 0 || $diem > 10) {
            return "Điểm không hợp lệ (Phải từ 0 đến 10)";
        }

        // Bước 2: Kiểm tra điều kiện TỪ CAO XUỐNG THẤP (Theo đúng HD)
        if ($diem >= 8) {
            return "<span class='giong'>Giỏi</span>";
        } elseif ($diem >= 6.5) {
            return "<span class='kha'>Khá</span>";
        } elseif ($diem >= 5) {
            return "<span class='tb'>Trung bình</span>";
        } else {
            // Các trường hợp còn lại (điểm < 5)
            return "<span class='yeu'>Chưa đạt</span>";
        }
    }

    // Xử lý khi người dùng nhấn nút Submit
    if (isset($_POST['submit'])) {
        $diemNhapVao = $_POST['score'];
        
        // Gọi hàm và lấy kết quả
        $ketQua = xepLoaiDiem($diemNhapVao);

        echo "<div class='result'>";
        echo "Điểm của bạn là: <strong>" . htmlspecialchars($diemNhapVao) . "</strong> <br>";
        echo "Xếp loại: " . $ketQua;
        echo "</div>";
    }
    ?>

</body>
</html>