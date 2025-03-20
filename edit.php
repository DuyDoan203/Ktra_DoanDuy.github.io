<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM sinhvien WHERE MaSV='$id'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    
    if ($_FILES['Hinh']['name']) {
        $Hinh = $_FILES['Hinh']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($Hinh);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
    } else {
        $Hinh = $row['Hinh'];
    }

    $sql = "UPDATE sinhvien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$Hinh', MaNganh='$MaNganh' WHERE MaSV='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location='index.php';</script>";
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
    <title>Chỉnh sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-uppercase">Chỉnh sửa thông tin sinh viên</h2>
        <form action="edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">HoTen</label>
                <input type="text" name="HoTen" class="form-control" value="<?= $row['HoTen'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">GioiTinh</label>
                <input type="text" name="GioiTinh" class="form-control" value="<?= $row['GioiTinh'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">NgaySinh</label>
                <input type="date" name="NgaySinh" class="form-control" value="<?= $row['NgaySinh'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hình</label>
                <input type="file" name="Hinh" class="form-control">
                <br>
                <img src="images/<?= $row['Hinh'] ?>" alt="Hình sinh viên" width="120">
            </div>
            <div class="mb-3">
                <label class="form-label">MaNganh</label>
                <input type="text" name="MaNganh" class="form-control" value="<?= $row['MaNganh'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <a href="index.php" class="mt-3 d-block">Back to List</a>
    </div>
</body>
</html>
