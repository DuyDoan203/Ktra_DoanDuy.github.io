<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['MaSV'];

    // Kiểm tra xem sinh viên có tồn tại không
    $result = $conn->query("SELECT * FROM sinhvien WHERE MaSV='$maSV'");

    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $maSV;
        echo "<script>alert('Đăng nhập thành công!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Mã sinh viên không tồn tại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-uppercase text-center">Đăng Nhập</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">MaSV</label>
                <input type="text" class="form-control" name="MaSV" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>
        <a href="index.php" class="d-block mt-3">Back to List</a>
    </div>
</body>
</html>
