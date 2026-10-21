<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Upload Ảnh Đại Diện An Toàn</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .container { }
        .nut:hover {  
        background-color : green ;
        font-size:20px ;
        color : white ;  
        }
        .error { color: red; margin-bottom: 10px; font-weight: bold;}
        .success { color: green; margin-bottom: 10px; font-weight: bold;}
        img { max-width: 200px; margin-top: 15px; border: 1px solid #ddd; border-radius: 5px; }
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
    <h2>Bài 3.6 upload ảnh đại diện </h2>
    
    <!-- Form upload, bắt buộc phải có enctype="multipart/form-data" -->
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="avatar" accept="image/*" required>
        <button type="submit" name="submit">Upload</button>
    </form>

    <?php
    // Chỉ xử lý khi form được submit và có file gửi lên
    if (isset($_POST['submit']) && isset($_FILES['avatar'])) {
        
        $file = $_FILES['avatar'];
        
        // Nếu người dùng không chọn file (error = 4)
        if ($file['error'] === UPLOAD_ERR_OK) {
            
            // --- BẮT ĐẦU 3 KIỂM TRA BẮT BUỘC ---

            // 1. Kiểm tra kích thước tối đa (Ví dụ: 2MB = 2 * 1024 * 1024 bytes)
            $maxSize = 2 * 1024 * 1024; 
            if ($file['size'] > $maxSize) {
                echo "<div class='error'>Lỗi: Kích thước file vượt quá 2MB.</div>";
                exit;
            }

            // 2. Kiểm tra phần mở rộng (Extension) cho phép
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                echo "<div class='error'>Lỗi: Chỉ cho phép upload file ảnh (.jpg, .jpeg, .png).</div>";
                exit;
            }

            // 3. Kiểm tra MIME Type (Bắt buộc phải là ảnh thực sự, không chỉ đổi đuôi)
            $allowedMimeTypes = ['image/jpeg', 'image/png'];
            // Hàm finfo_file dùng để lấy thông tin thực của file từ nội dung, không tin vào đuôi file
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, $allowedMimeTypes)) {
                echo "<div class='error'>Lỗi: File không phải là ảnh hợp lệ (MIME Type sai).</div>";
                exit;
            }

            // --- KẾT THÚC 3 KIỂM TRA ---

            // Nếu vượt qua hết, tiến hành lưu file

            // Đổi tên file để tránh trùng lặp và ngăn chặn việc đoán tên file (nguy hiểm)
            // Tạo tên mới: avatar_ + thời gian hiện tại + đuôi file
            $newFileName = 'avatar_' . time() . '.' . $extension;
            
            // Đường dẫn lưu file (thư mục uploads cùng cấp với file code)
            $uploadDir = 'uploads/';
            $destination = $uploadDir . $newFileName;

            // Di chuyển file từ thư mục tạm (tmp) sang thư mục đích
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo "<div class='success'>Upload thành công!</div>";
                // Hiển thị ảnh sau khi up (như yêu cầu: chỉ hiển thị khi đã kiểm tra hợp lệ)
                echo "<p>Tên file mới trên server: <strong>" . htmlspecialchars($newFileName) . "</strong></p>";
                echo "<img src='" . htmlspecialchars($destination) . "' alt='Ảnh đại diện'>";
            } else {
                echo "<div class='error'>Lỗi: Không thể lưu file vào thư mục uploads.</div>";
            }

        } else {
            echo "<div class='error'>Có lỗi xảy ra trong quá trình upload (Mã lỗi: " . $file['error'] . ").</div>";
        }
    }
    ?>

</div>

</body>
</html>