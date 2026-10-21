<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng điểm 3 sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 70%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #d6d8da; color: black; }
        .dat { color: green; font-weight: bold; }
        .truot { color: red; font-weight: bold; }
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
    <h2>Bài 2.8 bảng điểm sinh viên </h2>

    <?php
    // 1. Tạo mảng $students gồm 3 sinh viên
    $students = [
        ['name' => 'Nguyễn Văn An', 'midterm' => 8.0, 'final' => 7.5],
        ['name' => 'Trần Thị Bình', 'midterm' => 6.0, 'final' => 5.5],
        // Cố tình chèn thẻ HTML vào tên để kiểm tra bước 5
        ['name' => 'Lê Hoàng Chi ', 'midterm' => 4.0, 'final' => 3.5] 
    ];

    // 2. Viết hàm calculateAverage() tính điểm trung bình
    function calculateAverage(float $midterm, float $final): float {
        $diemTB = ($midterm + $final) / 2;
        return round($diemTB, 2); // Làm tròn 2 chữ số thập phân
    }

    // Bắt đầu vẽ bảng HTML
    echo "<table>";
    echo "<tr>
            <th>STT</th>
            <th>Tên Sinh Viên</th>
            <th>Điểm Giữa Kỳ</th>
            <th>Điểm Cuối Kỳ</th>
            <th>Điểm Trung Bình</th>
            <th>Kết Quả</th>
          </tr>";

    // 3. Dùng foreach để in bảng HTML
    $stt = 1;
    foreach ($students as $student) {
        $ten = $student['name'];
        $giuaKy = $student['midterm'];
        $cuoiKy = $student['final'];

        // Gọi hàm tính điểm (Bước 2)
        $diemTB = calculateAverage($giuaKy, $cuoiKy);

        // 4. Thêm cột kết quả: Đạt nếu điểm trung bình >= 5
        if ($diemTB >= 5.0) {
            $ketQua = "<span class='dat'>Đạt</span>";
        } else {
            $ketQua = "<span class='truot'>Chưa đạt</span>";
        }

        // 5. Mã hóa tên sinh viên bằng htmlspecialchars() trước khi in
        $tenAnToan = htmlspecialchars($ten);

        // In ra các dòng của bảng
        echo "<tr>";
        echo "<td>" . $stt . "</td>";
        echo "<td>" . $tenAnToan . "</td>";
        echo "<td>" . $giuaKy . "</td>";
        echo "<td>" . $cuoiKy . "</td>";
        echo "<td><strong>" . $diemTB . "</strong></td>";
        echo "<td>" . $ketQua . "</td>";
        echo "</tr>";

        $stt++;
    }

    echo "</table>";
    ?>

</body>
</html>