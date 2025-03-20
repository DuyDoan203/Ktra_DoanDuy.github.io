<?php
include 'config.php';
session_start();
$MaSV = isset($_SESSION['MaSV']) ? $_SESSION['MaSV'] : 'SV001';
$sql = "SELECT hocphan.MaHP, hocphan.TenHP, hocphan.SoTinChi 
        FROM chitietdangky 
        JOIN hocphan ON chitietdangky.MaHP = hocphan.MaHP 
        JOIN dangky ON chitietdangky.MaDK = dangky.MaDK
        WHERE dangky.MaSV = '$MaSV'";

$result = $conn->query($sql);
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
        <h2 class="text-uppercase text-center">Đăng Ký Học Phần</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalTinChi = 0;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['MaHP'] . "</td>";
                    echo "<td>" . $row['TenHP'] . "</td>";
                    echo "<td>" . $row['SoTinChi'] . "</td>";
                    echo "<td><a href='xoa.php?MaHP=" . $row['MaHP'] . "' class='btn btn-danger'>Xóa</a></td>";
                    echo "</tr>";
                    $totalTinChi += $row['SoTinChi'];
                }
                ?>
            </tbody>
        </table>
        <p class="text-danger fw-bold">Số học phần: <?php echo $result->num_rows; ?></p>
        <p class="text-danger fw-bold">Tổng số tín chỉ: <?php echo $totalTinChi; ?></p>
        <a href="xoa_toan_bo.php" class="btn btn-warning">Xóa Đăng Ký</a>
        <a href="hocphan.php" class="btn btn-primary">Đăng ký thêm</a>
    </div>
</body>
</html>
