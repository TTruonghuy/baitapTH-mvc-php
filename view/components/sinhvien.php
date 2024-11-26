<?php
require_once '../controller/components/sinhvien_controller.php';

$sinhvienController = new SinhVienController();
$sinhvienList = $sinhvienController->getAllSinhVien();
?>
<main class="main">
    <!-- Hero Section -->
    <section id="sinhvien" >
        
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-out">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h3>Danh sách Sinh viên</h3>
                    <div justify-content="space-between">
                        <input type="text">
                        <button class="btn-add">
                            <img class="add-icon" src="../public/find.png" alt="">
                        </button>
                        <button class="btn-add-1">
                            <img class="add-icon" src="../public/add.png" alt="">
                        </button>
                        <p></p>
                    </div>
                    <table border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ và tên</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>Lớp</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sinhvienList as $sinhvien): ?>
                                <tr>
                                    <td><?= htmlspecialchars($sinhvien['sinhvien_id']); ?></td>
                                    <td><?= htmlspecialchars($sinhvien['ho_ten']); ?></td>
                                    <td><?= htmlspecialchars($sinhvien['ngay_sinh']); ?></td>
                                    <td><?= htmlspecialchars($sinhvien['gioi_tinh']); ?></td>
                                    <td><?= htmlspecialchars($sinhvien['ten_lop']); ?></td>
                                    <td>
                                        <button class="btn-add"><img class="add-icon" src="../public/pen.ico"></button>
                                        <button class="btn-add"><img class="add-icon" src="../public/delete.ico"></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section><!-- /Hero Section -->