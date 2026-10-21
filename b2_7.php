<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn học liệu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { margin-bottom: 20px; }
        input { padding: 5px; margin-right: 5px; border: 1px solid #ccc; }
        .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
        .ket-qua {   }
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
    <h2>Bài 2.7 hóa đơn học liệu  </h2>
    <?php
    // 1. Hàm định dạng tiền tệ (thêm dấu chấm phân cách và ký hiệu đ)
    function money(float $value): string {
        return number_format($value, 0, ',', '.') . ' đ';
    }

    // 2. Lấy dữ liệu từ POST (Sử dụng toán tử ?? để gán giá trị mặc định nếu chưa có)
    $name = $_POST['name'] ?? '';
    // Ép kiểu int cho số lượng (vì không ai mua nửa cuốn sách)
    $qty = (int)($_POST['qty'] ?? 0); 
    // Ép kiểu float cho đơn giá (có thể có phần thập phân)
    $price = (float)($_POST['price'] ?? 0);

    // 3. Tính tổng tiền
    $total = $qty * $price;
    ?>

    <!-- 4. Form nhập liệu -->
    <form method="POST">
        <input type="text" name="name" placeholder="Tên tài liệu" required>
        <input type="number" name="qty" placeholder="Số lượng" min="1" required>
        <input type="number" name="price" placeholder="Đơn giá" min="0"  required>
        <button type="submit">Tính</button>
    </form>

    <!-- 5. Hiển thị kết quả nếu tổng tiền > 0 -->
    <?php if ($total > 0): ?>
        <div class="ket-qua">
            <!-- Mã hóa tên tài liệu để bảo mật, và dùng hàm money() để in tiền -->
            <p><strong><?= htmlspecialchars($name) ?>:</strong> <?= money($total) ?></p>
        </div>
    <?php endif; ?>

</body>
</html>