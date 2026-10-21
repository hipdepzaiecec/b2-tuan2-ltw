<?php
// Khởi tạo các biến chứa lỗi và dữ liệu (Mảng $data, $errors như hướng dẫn)
$errors = [];
$data = ['name' => '', 'email' => '', 'birthday' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Lấy dữ liệu và cắt khoảng trắng (trim)
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['birthday'] = trim($_POST['birthday'] ?? '');

    // 2. Kiểm tra bắt buộc (Tên không được để trống)
    if ($data['name'] === '') {
        $errors['name'] = "Vui lòng nhập họ tên";
    }

    // 3. Kiểm tra Email hợp lệ (Không được trống và đúng định dạng)
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ";
    }

    // 4. Kiểm tra Ngày sinh (Không được để trống)
    if ($data['birthday'] === '') {
        $errors['birthday'] = "Vui lòng nhập ngày sinh";
    }

    // 5. Nếu không có lỗi nào -> Chuyển hướng sang trang thành công
    if (empty($errors)) { // Dùng empty() an toàn hơn count($errors) == 0
        header("Location: b3_7_2.php");
        exit();
    }
}

// Hàm phụ trợ để in dữ liệu an toàn (chống XSS)
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 120px; font-weight: bold; }
        input { padding: 5px; width: 250px; border: 1px solid #ccc; }
        .error { color: red; font-size: 14px; margin-left: 125px; display: block; margin-top: 5px;}
       .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
        .has-error input { border-color: red; } /* Đổi viền đỏ nếu có lỗi */
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
    <h2>Bài 3.7 đăng ký sinh viên </h2>

    <form method="POST" action="">
        <!-- Trường Họ tên -->
        <div class="form-group <?php echo isset($errors['name']) ? 'has-error' : ''; ?>">
            <label for="name">Họ và tên:</label>
            <!-- Giữ lại dữ liệu cũ bằng hàm e($data['name']) -->
            <input type="text" name="name" id="name" value="<?php echo e($data['name']); ?>">
            <?php if (isset($errors['name'])): ?>
                <span class="error"><?php echo $errors['name']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Trường Email -->
        <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : ''; ?>">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo e($data['email']); ?>">
            <?php if (isset($errors['email'])): ?>
                <span class="error"><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </div>

        <!-- Trường Ngày sinh -->
        <div class="form-group <?php echo isset($errors['birthday']) ? 'has-error' : ''; ?>">
            <label for="birthday">Ngày sinh:</label>
            <input type="date" name="birthday" id="birthday" value="<?php echo e($data['birthday']); ?>">
            <?php if (isset($errors['birthday'])): ?>
                <span class="error"><?php echo $errors['birthday']; ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">Đăng Ký</button>
    </form>

</body>
</html>