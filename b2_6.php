<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tính tiền tài liệu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        
        /* CSS cho Form giống trong ảnh */
        .form-container {
           
            padding: 15px;
            width: 700px;
            
        }
        input[type="text"], input[type="number"] {
            padding: 5px;
            margin-right: 5px;
            border: 1px solid #ccc;
        }
        .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }

        /* CSS cho phần kết quả */
        .ket-qua {
            margin-top: 15px;
            font-size: 18px;
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
    <h2>Bài 2.6 tính tiền tài liệu </h2>
    <div class="form-container">
        <!-- Form nhập liệu -->
        <form method="POST" action="">
            <input type="text" name="ten_tai_lieu" placeholder="Tên tài liệu" required>
            <input type="number" name="so_luong" placeholder="Số lượng" min="1" required>
            <input type="number" name="don_gia" placeholder="Đơn giá" min="0" required>
            <button type="submit" name="submit">Tính</button>
        </form>

        <?php
        // Xử lý khi người dùng nhấn nút "Tính"
        if (isset($_POST['submit'])) {
            // Lấy dữ liệu từ form
            $ten = $_POST['ten_tai_lieu'];
            $soLuong = (float)$_POST['so_luong'];
            $donGia = (float)$_POST['don_gia'];

            // Tính tổng tiền
            $tongTien = $soLuong * $donGia;

            // Hiển thị kết quả (định dạng số có dấu chấm phân cách hàng nghìn)
            echo "<div class='ket-qua'>";
            // Sử dụng htmlspecialchars để bảo mật khi in tên tài liệu
            echo htmlspecialchars($ten) . ": " . number_format($tongTien, 0, ',', '.') . " đ";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>