<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .pass { color: green; font-weight: bold; }
        .fail { color: red; font-weight: bold; }
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
    <h2>Bài 2.4 danh sách sinh viên</h2>

    <?php
    // 1. Tạo mảng kết hợp chứa thông tin 3 sinh viên
    // Mỗi sinh viên là một mảng con có khóa 'name' và 'score'
    $students = [
        ['name' => 'An', 'score' => 8.0],
        ['name' => 'Bình', 'score' => 6.5],
        ['name' => 'Chi', 'score' => 4.5]
    ];

    // 2. Hiển thị dữ liệu ra bảng HTML bằng vòng lặp foreach
    echo "<table>";
    echo "<tr><th>STT</th><th>Tên Sinh Viên</th><th>Điểm</th></tr>";
    
    $stt = 1; // Biến đếm số thứ tự
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . $stt . "</td>";
        echo "<td>" . $student['name'] . "</td>";
        echo "<td>" . $student['score'] . "</td>";
        
       
        
        echo "</tr>";
        $stt++;
    }
    
    echo "</table>";
    ?>

</body>
</html>