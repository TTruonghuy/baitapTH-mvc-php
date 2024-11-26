<?php
require_once __DIR__ . '/../../model/bomon.php'; // Gọi model chứa các phương thức thao tác CSDL

class BoMonController {
    private $bomonModel;

    public function __construct() {
        $this->bomonModel = new BoMon();
    }

    // Hàm hiển thị danh sách bộ môn
    public function getAllBoMon() {
        return $this->bomonModel->getAllBoMon();
    }

    // Hàm xử lý thêm hoặc cập nhật bộ môn
    public function saveBoMon() {
        $id = isset($_POST['bomon_id']) ? $_POST['bomon_id'] : '';
        $name = isset($_POST['ten_bomon']) ? $_POST['ten_bomon'] : '';

        if (empty($id)) {
            $this->bomonModel->addBoMon($name);  // Thêm bộ môn
        } else {
            $this->bomonModel->updateBoMon($id, $name);  // Cập nhật bộ môn
        }

        header("Location: http://localhost/Newfolder/view/home.php#bomon");
        exit;
    }

    // Hàm xử lý xóa bộ môn
    public function deleteBoMon() {
        $id = isset($_POST['bomon_id']) ? $_POST['bomon_id'] : '';
        if (!empty($id)) {
            $this->bomonModel->deleteBoMon($id);  // Xóa bộ môn
        }
    
        // Không chuyển hướng nữa, chỉ trả về phản hồi success
        echo json_encode(["status" => "success"]);
        exit;
    }
    public function searchBoMon() {
        $name = isset($_POST['search']) ? $_POST['search'] : '';
        $bomonList = $this->bomonModel->searchBoMon($name);  // Gọi phương thức tìm kiếm trong model
    
        // Trả về kết quả tìm kiếm dưới dạng JSON
        echo json_encode($bomonList);
        exit;
    }
}

// Kiểm tra action từ form và gọi hàm tương ứng
if (isset($_POST['action'])) {
    $controller = new BoMonController();
    switch ($_POST['action']) {
        case 'save':
            $controller->saveBoMon();
            break;
        case 'delete':
            $controller->deleteBoMon();
            break;
        case 'search':
            $controller->searchBoMon();
            break;
    }
}
?>
