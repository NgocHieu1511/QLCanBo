<?php
include "connect.php";

// lấy id an toàn
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// lấy dữ liệu
$result = mysqli_query($conn, "SELECT * FROM tblcanbo WHERE macb=$id");

if (!$result) {
    die("Lỗi SQL: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa cán bộ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4>Cập nhật cán bộ</h4>
            </div>

            <div class="card-body">
                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="ho_ten" class="form-control" value="<?= $row['ho_ten'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phòng ban</label>
                        <input type="text" name="phong_ban" class="form-control" value="<?= $row['phong_ban'] ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quê quán</label>
                        <input type="text" name="que_quan" class="form-control" value="<?= $row['que_quan'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giới tính</label>
                        <select name="gioi_tinh" class="form-select">
                            <option value="1" <?= $row['gioi_tinh'] == 1 ? 'selected' : '' ?>>Nam</option>
                            <option value="0" <?= $row['gioi_tinh'] == 0 ? 'selected' : '' ?>>Nữ</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lương cơ bản</label>
                        <input type="number" name="luong" class="form-control" value="<?= $row['luong_co_ban'] ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bậc lương</label>
                        <input type="number" name="bac" class="form-control" value="<?= $row['bac_luong'] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="index.php" class="btn btn-secondary">Quay lại</a>

                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ho_ten = mysqli_real_escape_string($conn, $_POST['ho_ten']);
    $phong_ban = mysqli_real_escape_string($conn, $_POST['phong_ban']);
    $que_quan = mysqli_real_escape_string($conn, $_POST['que_quan']);
    $gioi_tinh = $_POST['gioi_tinh'];
    $luong = $_POST['luong'];
    $bac = $_POST['bac'];

    $sql = "UPDATE tblcanbo SET 
        ho_ten='$ho_ten',
        phong_ban='$phong_ban',
        que_quan='$que_quan',
        gioi_tinh=$gioi_tinh,
        luong_co_ban=$luong,
        bac_luong=$bac
        WHERE macb=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
    }
}
?>