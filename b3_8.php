<?php
// Khởi tạo mảng chứa lỗi và dữ liệu cũ
$errors = [];
$data = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Lấy dữ liệu và cắt khoảng trắng
    $data['name']    = trim($_POST['name'] ?? '');
    $data['email']   = trim($_POST['email'] ?? '');
    $data['subject'] = trim($_POST['subject'] ?? '');
    $data['message'] = trim($_POST['message'] ?? '');

    // 2. Kiểm tra Họ tên và Nội dung không được rỗng
    if ($data['name'] === '') {
        $errors['name'] = "Vui lòng nhập họ tên.";
    }
    if ($data['message'] === '') {
        $errors['message'] = "Vui lòng nhập nội dung.";
    } elseif (mb_strlen($data['message']) < 10) { // Yêu cầu từ 10 ký tự trở lên (như trong ảnh)
        $errors['message'] = "Nội dung phải từ 10 ký tự trở lên.";
    }

    // 3. Kiểm tra email đúng định dạng
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ.";
    }

    // 4. Kiểm tra Upload ảnh (3 kiểm tra bắt buộc)
    $uploadSuccess = false;
    $newFileName = '';
    
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['avatar'];
        $maxSize = 2 * 1024 * 1024; // 2MB
        $allowedExts = ['jpg', 'jpeg', 'png'];
        $allowedMimes = ['image/jpeg', 'image/png'];
        
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Kiểm tra 1: Kích thước
        if ($file['size'] > $maxSize) {
            $errors['avatar'] = "Kích thước ảnh vượt quá 2MB.";
        } 
        // Kiểm tra 2: Định dạng đuôi file
        elseif (!in_array($ext, $allowedExts)) {
            $errors['avatar'] = "Chỉ cho phép file ảnh (.jpg, .jpeg, .png).";
        } 
        else {
            // Kiểm tra 3: MIME Type thực tế
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (!in_array($mime, $allowedMimes)) {
                $errors['avatar'] = "File không phải là ảnh hợp lệ (MIME Type sai).";
            } else {
                // Nếu qua hết, đổi tên và lưu file
                $newFileName = 'avatar_' . time() . '.' . $ext;
                $destination = 'uploads/' . $newFileName;
                
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $uploadSuccess = true;
                } else {
                    $errors['avatar'] = "Không thể lưu file lên server.";
                }
            }
        }
    } else {
        $errors['avatar'] = "Vui lòng chọn ảnh đại diện.";
    }

    // 5. Nếu không có lỗi -> Thành công
    if (empty($errors)) {
        // Ở đây bạn có thể thêm code lưu vào CSDL (Database) nếu muốn
        $successMsg = "Gửi liên hệ thành công!";
        // Reset lại dữ liệu form nếu thành công
        $data = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];
    }
}

// Hàm in dữ liệu an toàn
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form Liên Hệ</title>
    <style>
       body { 
    font-family: Arial, sans-serif; 
    background-color: #f4f7f6; 
    padding: 30px; 
    /* Đã xóa display: flex và justify-content */
}
.nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
.form-container { 
    background: #fff; 
    padding: 30px; 
    border-radius: 8px; 
    width: 700px; 
    margin: 0 auto; /* Căn giữa khối form ra giữa màn hình */
    margin-top: 30px; /* Khoảng cách từ các nút phía trên xuống form */
}
        h2 { text-align: center; color: #070707; margin-top: 0; }
        .subtitle { text-align: center; color: #7f8c8d; font-size: 14px; margin-bottom: 20px; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input[type="text"], input[type="email"], select, textarea {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit;
        }
        textarea { resize: vertical; height: 100px; }
        
        /* CSS cho trạng thái lỗi */
        .has-error input, .has-error select, .has-error textarea { border-color: #e74c3c; background-color: #fdf2f2; }
        .error-msg { color: #e74c3c; font-size: 13px; margin-top: 5px; display: block; }
        
        .button1 { width: 100%; padding: 12px; background-color: #2980b9; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px;}
        .button1:hover { background-color: #2471a3; }
        
        .success-msg { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; border: 1px solid #c3e6cb;}
        .uploaded-img { display: block; margin: 10px auto; max-width: 100px; border-radius: 50%; object-fit: cover;}
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
    <br>
    <br>
    <br>
    <br>

<div class="form-container">
    <h2>Bài 3.8 liên hệ</h2>
    <p class="subtitle">Vui lòng nhập đầy đủ thông tin bên dưới.</p>

    <!-- Hiển thị thông báo thành công -->
    <?php if (isset($successMsg)): ?>
        <div class="success-msg"><?= $successMsg ?></div>
        <?php if ($uploadSuccess && $newFileName): ?>
            <img src="uploads/<?= e($newFileName) ?>" alt="Avatar" class="uploaded-img">
        <?php endif; ?>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        
        <!-- Trường Họ tên -->
        <div class="form-group <?= isset($errors['name']) ? 'has-error' : '' ?>">
            <label for="name">Họ tên</label>
            <input type="text" name="name" id="name" value="<?= e($data['name']) ?>" placeholder="Nhập tên của bạn ... ">
            <?php if (isset($errors['name'])): ?><span class="error-msg"><?= $errors['name'] ?></span><?php endif; ?>
        </div>

        <!-- Trường Email -->
        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= e($data['email']) ?>" placeholder="Nhập email của bạn ...">
            <?php if (isset($errors['email'])): ?><span class="error-msg"><?= $errors['email'] ?></span><?php endif; ?>
        </div>

        <!-- Trường Chủ đề -->
        <div class="form-group">
            <label for="subject">Chủ đề</label>
            <select name="subject" id="subject">
                <option value="Hỗ trợ kỹ thuật" <?= $data['subject'] === 'Hỗ trợ kỹ thuật' ? 'selected' : '' ?>>Hỗ trợ kỹ thuật</option>
                <option value="Góp ý" <?= $data['subject'] === 'Góp ý' ? 'selected' : '' ?>>Góp ý</option>
                <option value="Khác" <?= $data['subject'] === 'Khác' ? 'selected' : '' ?>>Khác</option>
            </select>
        </div>

        <!-- Trường Nội dung -->
        <div class="form-group <?= isset($errors['message']) ? 'has-error' : '' ?>">
            <label for="message">Nội dung</label>
            <textarea name="message" id="message" placeholder="Nhập nội dung liên hệ..."><?= e($data['message']) ?></textarea>
            <?php if (isset($errors['message'])): ?><span class="error-msg"><?= $errors['message'] ?></span><?php endif; ?>
        </div>

        <!-- Trường Upload ảnh (Thêm mới theo yêu cầu) -->
        <div class="form-group <?= isset($errors['avatar']) ? 'has-error' : '' ?>">
            <label for="avatar">Ảnh đại diện (Tối đa 2MB, JPG/PNG)</label>
            <input type="file" name="avatar" id="avatar" accept=".jpg, .jpeg, .png">
            <?php if (isset($errors['avatar'])): ?><span class="error-msg"><?= $errors['avatar'] ?></span><?php endif; ?>
        </div>

        <button class="button1" type="submit">Gửi liên hệ</button>
    </form>
</div>

</body>
</html>