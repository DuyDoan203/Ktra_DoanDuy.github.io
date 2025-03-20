<?php
session_start();
include 'config.php';

if (isset($_GET['remove'])) {
    $removeID = $_GET['remove'];
    if (isset($_SESSION['cart'][$removeID])) {
        unset($_SESSION['cart'][$removeID]);
    }
}

if (isset($_GET['save'])) {
    if (!isset($_SESSION['MaSV'])) {
        echo "<script>alert('Bạn cần đăng nhập!'); window.location='login.php';</script>";
        exit();
    }
    $MaSV = $_SESSION['MaSV'];
    foreach ($_SESSION['cart'] as $MaHP => $hocphan) {
        $conn->query("INSERT INTO dangkyhocphan (MaSV, MaHP) VALUES ('$MaSV', '$MaHP')");
    }
    $_SESSION['cart'] = [];
    echo "<script>alert('Lưu đăng ký thành công!'); window.location='cart.php';</script>";
}

$totalCredits = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-uppercase text-center">Đăng Ký Học Phần</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>MaHP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $MaHP => $hocphan): ?>
                        <tr>
                            <td><?= $MaHP ?></td>
                            <td><?= $hocphan['TenHP'] ?></td>
                            <td><?= $hocphan['SoTinChi'] ?></td>
                            <td><a href="cart.php?remove=<?= $MaHP ?>" class="text-danger">Xóa</a></td>
                        </tr>
                        <?php $totalCredits += $hocphan['SoTinChi']; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Chưa có học phần nào được đăng ký.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p><strong>Số học phần:</strong> <?= count($_SESSION['cart']) ?></p>
        <p><strong>Tổng số tín chỉ:</strong> <?= $totalCredits ?></p>

        <a href="cart.php?save=true" class="btn btn-success">Lưu đăng ký</a>
        <a href="cart.php?remove=all" class="btn btn-danger">Xóa Đăng Ký</a>
        <a href="index.php" class="d-block mt-3">Back to List</a>
    </div>
</body>
</html>
