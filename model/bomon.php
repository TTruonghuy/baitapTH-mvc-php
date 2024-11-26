<?php
require_once 'database_connect.php'; // Kết nối cơ sở dữ liệu

class BoMon {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllBoMon() {
        $query = "SELECT * FROM bomon";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute();

        // Lấy dữ liệu sử dụng MySQLi
        $result = $stmt->get_result(); // Lấy đối tượng kết quả
        $bomonList = [];
        while ($row = $result->fetch_assoc()) {
            $bomonList[] = $row; // Thêm từng hàng dữ liệu vào mảng
        }
        return $bomonList;
    }

    public function addBoMon($name) {
        $query = "INSERT INTO bomon (ten_bomon) VALUES (?)";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Thêm bộ môn thành công!'];
        }
        return ['status' => 'error', 'message' => 'Lỗi khi thêm bộ môn.'];
    }

    public function updateBoMon($id, $name) {
        $query = "UPDATE bomon SET ten_bomon = ? WHERE bomon_id = ?";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Cập nhật bộ môn thành công!'];
        }
        return ['status' => 'error', 'message' => 'Lỗi khi cập nhật bộ môn.'];
    }

    public function deleteBoMon($id) {
        $query = "DELETE FROM bomon WHERE bomon_id = ?";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Xóa bộ môn thành công!'];
        }
        return ['status' => 'error', 'message' => 'Lỗi khi xóa bộ môn.'];
    }

    // Trong model/bomon.php
    public function searchBoMon($name) {
        $query = "SELECT * FROM bomon WHERE ten_bomon LIKE ?";
        $stmt = $this->db->connect()->prepare($query);
        $searchTerm = "%" . $name . "%"; // Định dạng từ khóa tìm kiếm
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $bomonList = [];
        while ($row = $result->fetch_assoc()) {
            $bomonList[] = $row;
        }
        return $bomonList;
    }

}
?>
