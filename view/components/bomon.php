<?php
require_once '../controller/components/bomon_controller.php';

$bomonController = new BoMonController();
$bomonList = $bomonController->getAllBoMon();
?>
<main class="main">
    <section id="bomon">
        <div id="bomonModalBlock" style="display: block;">
            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-out">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h3>Danh sách Bộ môn</h3>
                        <div justify-content="space-between">
                            <input type="text" id="searchInput" placeholder="Tìm kiếm bộ môn..." oninput="searchBoMon()">
                            <img class="add-icon" src="../public/find.png" alt="">
                            <button class="btn-add-1" onclick="showBoMonForm()">
                                <img class="add-icon" src="../public/add.png" alt="">
                            </button>
                            <p></p>
                        </div>
                        <table border="1" cellspacing="0" cellpadding="10">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Bộ môn</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="bomonTableBody">
                                <?php foreach ($bomonList as $bomon): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($bomon['bomon_id']); ?></td>
                                        <td><?= htmlspecialchars($bomon['ten_bomon']); ?></td>
                                        <td>
                                            <button class="btn-add" onclick="editBoMon(<?= $bomon['bomon_id']; ?>, '<?= htmlspecialchars($bomon['ten_bomon']); ?>')">
                                                <img class="add-icon" src="../public/pen.ico">
                                            </button>
                                            <button class="btn-add" onclick="deleteBoMon(<?= $bomon['bomon_id']; ?>)">
                                                <img class="add-icon" src="../public/delete.ico">
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Thêm/Sửa Bộ môn -->
    <div id="bomonModal" class="modal" style="display: none;">
        <div>
            <span onclick="closeBoMonForm()" class="close">&times;</span>
            <p class="p-bt">Thêm/Sửa bộ môn</p>
            <form id="bomonForm" method="POST" action="../controller/components/bomon_controller.php">
                <input type="hidden" id="bomonId" name="bomon_id">
                <input type="hidden" name="action" value="save">
                <div class="form-group1">
                    <label for="tenBomon">Tên Bộ môn:</label>
                    <input type="text" id="tenBomon" name="ten_bomon" required>
                </div>
                <div class="btn-login-container">
                    <button type="submit" class="btn-login">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Hiển thị form thêm/sửa bộ môn
        function showBoMonForm() {
            document.getElementById("bomonId").value = "";
            document.getElementById("tenBomon").value = "";
            document.getElementById("bomonModal").style.display = "block";
        }

        function closeBoMonForm() {
            document.getElementById("bomonModal").style.display = "none";
        }

        function editBoMon(id, name) {
            document.getElementById("bomonId").value = id;
            document.getElementById("tenBomon").value = name;
            document.getElementById("bomonModal").style.display = "block";
        }

        function deleteBoMon(id) {
            if (confirm("Bạn có chắc chắn muốn xóa bộ môn này không?")) {
                const formData = new FormData();
                formData.append("bomon_id", id);
                formData.append("action", "delete");

                fetch("../controller/components/bomon_controller.php", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.json())  // Xử lý phản hồi JSON từ PHP
                    .then(data => {
                        if (data.status === "success") {
                            // Sau khi xóa thành công, chuyển hướng và tải lại phần #bomon
                            alert("Bộ môn đã được xóa thành công!");
                            window.location.reload(); // Tải lại trang hiện tại
                        } else {
                            alert("Có lỗi xảy ra khi xóa bộ môn!");
                        }
                    })
                    .catch(error => {
                        alert("Có lỗi xảy ra khi xóa!");
                        console.error("Error:", error);
                    });
            }
        }

        function searchBoMon() {
            const searchTerm = document.getElementById("searchInput").value;

            const formData = new FormData();
            formData.append("search", searchTerm);
            formData.append("action", "search");

            fetch("../controller/components/bomon_controller.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Hiển thị lại danh sách bộ môn tìm được
                const tableBody = document.getElementById("bomonTableBody");
                tableBody.innerHTML = "";  // Xóa hết nội dung cũ

                data.forEach(bomon => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${bomon.bomon_id}</td>
                        <td>${bomon.ten_bomon}</td>
                        <td>
                            <button class="btn-add" onclick="editBoMon(${bomon.bomon_id}, '${bomon.ten_bomon}')">
                                <img class="add-icon" src="../public/pen.ico">
                            </button>
                            <button class="btn-add" onclick="deleteBoMon(${bomon.bomon_id})">
                                <img class="add-icon" src="../public/delete.ico">
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    </script>
</main>