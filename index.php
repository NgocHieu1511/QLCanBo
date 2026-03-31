<?php include "connect.php"; ?>

<?php
// lấy dữ liệu
$result = mysqli_query($conn, "SELECT * FROM tblcanbo");

// thống kê
$total = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Cán bộ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        display: flex;
    }



    .content {
        flex: 1;
        padding: 20px;
    }

    .card {
        border-radius: 10px;
    }
    </style>
</head>

<body>



    <!-- CONTENT -->
    <div class="content">

        <h2 class="text-center my-3 fw-bold">QUẢN LÝ CÁN BỘ </h2>

        <!-- CARD THỐNG KÊ -->
        <div class="row mb-4 ">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <div class="card bg-primary text-white p-3 text-center" style="width: 200px;">
                    <h5">Tổng cán bộ</h5>
                        <h3><?= $total ?></h3>
                </div>
                <button class="btn btn-success" onclick="window.location.href='add.php'">Thêm mới</button>
            </div>
        </div>

        <!-- TÌM KIẾM -->
        <form method="GET" class="mb-3 d-flex align-items-center row">
            <div class="col-md-6">
                <input class="form-control " type="text" name="keyword" placeholder="Tìm theo tên...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary mt-2" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <!-- BẢNG -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Mã</th>
                    <th>Họ tên</th>
                    <th>Phòng ban</th>
                    <th>Quê quán</th>
                    <th>Giới tính</th>
                    <th>Lương</th>
                    <th>Bậc</th>
                    <th>Tổng thu nhập</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                <?php
        $sql = "SELECT * FROM tblcanbo";

        if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
            $key = mysqli_real_escape_string($conn, $_GET['keyword']);
            $sql = "SELECT * FROM tblcanbo WHERE ho_ten LIKE '%$key%'";
        }

        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $tong = $row['luong_co_ban'] * $row['bac_luong'];
        ?>

                <tr>
                    <td><?= $row['macb'] ?></td>
                    <td><?= $row['ho_ten'] ?></td>
                    <td><?= $row['phong_ban'] ?></td>
                    <td><?= $row['que_quan'] ?></td>
                    <td><?= $row['gioi_tinh'] == 1 ? "Nam" : "Nữ" ?></td>
                    <td><?= $row['luong_co_ban'] ?></td>
                    <td><?= $row['bac_luong'] ?></td>
                    <td><?= $tong ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['macb'] ?>">Sửa</a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['macb'] ?>">Xóa</a>

                    </td>
                </tr>

                <?php } ?>

            </tbody>
        </table>

    </div>

</body>

</html>