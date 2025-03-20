<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['MaSV'];
    $result = $conn->query("SELECT * FROM sinhvien WHERE MaSV='$maSV'");

    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $maSV;
        echo "<script>
                document.getElementById('alert-success').style.display = 'block';
                setTimeout(() => { window.location='index.php'; }, 1500);
              </script>";
    } else {
        echo "<script>document.getElementById('alert-fail').style.display = 'block';</script>";
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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2 class="text-center text-uppercase">Đăng Nhập</h2>

        <!-- Thông báo thành công -->
        <div id="alert-success" class="alert alert-success text-center">Đăng nhập thành công! Đang chuyển hướng...</div>
        <!-- Thông báo thất bại -->
        <div id="alert-fail" class="alert alert-danger text-center">Mã sinh viên không tồn tại!</div>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Mã Sinh Viên</label>
                <input type="text" class="form-control" name="MaSV" placeholder="Nhập mã sinh viên" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
        </form>
        <a href="index.php" class="d-block text-center mt-3 text-decoration-none">⬅ Quay lại trang chủ</a>
    </div>
</div>

<script>
    // Hiển thị thông báo lỗi hoặc thành công ngay khi có
    window.onload = function() {
        if (document.getElementById('alert-success').innerText.trim() !== "") {
            document.getElementById('alert-success').style.display = 'block';
        }
        if (document.getElementById('alert-fail').innerText.trim() !== "") {
            document.getElementById('alert-fail').style.display = 'block';
        }
    }
</script>

</body>
</html>
