<?php
include 'config.php';
session_start();
$MaSV = isset($_SESSION['MaSV']) ? $_SESSION['MaSV'] : 'SV001'; 

$result = $conn->query("SELECT * FROM hocphan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký học phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-uppercase text-center">Danh Sách Học Phần</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Đăng Ký</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['MaHP'] ?></td>
                    <td><?= $row['TenHP'] ?></td>
                    <td><?= $row['SoTinChi'] ?></td>
                    <td>
                        <form method="POST" action="dangky.php">
                            <input type="hidden" name="MaHP" value="<?= $row['MaHP'] ?>">
                            <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                            <button type="submit" class="btn btn-success">Đăng Ký</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</body>
</html>
