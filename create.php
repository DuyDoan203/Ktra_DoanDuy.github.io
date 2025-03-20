<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    $Hinh = $_FILES['Hinh']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($Hinh);
    move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);

    $sql = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location='index.php';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-uppercase">Thêm Sinh Viên</h2>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">MaSV</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">HoTen</label>
                <input type="text" name="HoTen" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">GioiTinh</label>
                <input type="text" name="GioiTinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">NgaySinh</label>
                <input type="date" name="NgaySinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hình</label>
                <input type="file" name="Hinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">MaNganh</label>
                <input type="text" name="MaNganh" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <a href="index.php" class="mt-3 d-block">Back to List</a>
    </div>
</body>
</html>
