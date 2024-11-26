<?php
require_once '../controller/components/giaovien_controller.php';

$giaovienController = new GiaoVienController();
$giaovienList = $giaovienController->getAllGiaoVien();
?>
<main class="main">
    <!-- Hero Section -->
    <section id="giaovien" >
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-out">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h3>Danh sách Giáo viên</h3>
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
                                <th>Thuộc bộ môn</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($giaovienList as $giaovien): ?>
                                <tr>
                                    <td><?= htmlspecialchars($giaovien['giaovien_id']); ?></td>
                                    <td><?= htmlspecialchars($giaovien['ho_ten']); ?></td>
                                    <td><?= htmlspecialchars($giaovien['ngay_sinh']); ?></td>
                                    <td><?= htmlspecialchars($giaovien['gioi_tinh']); ?></td>
                                    <td><?= htmlspecialchars($giaovien['ten_bomon']); ?></td>
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