<?php
require_once '../controller/components/lop_controller.php';

$lopController = new LopController();
$lopList = $lopController->getAllLop();
?>
<main class="main">
    <!-- Hero Section -->
    <section id="lop" >
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-out">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h3>Danh sách Lớp</h3>
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
                                <th>Tên Lớp</th>
                                <th>Thuộc Bộ môn</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lopList as $lop): ?>
                                <tr>
                                    <td><?= htmlspecialchars($lop['lop_id']); ?></td>
                                    <td><?= htmlspecialchars($lop['ten_lop']); ?></td>
                                    <td><?= htmlspecialchars($lop['ten_bomon']); ?></td>
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