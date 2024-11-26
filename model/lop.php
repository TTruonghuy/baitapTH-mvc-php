
<?php
require_once 'database_connect.php'; // Kết nối cơ sở dữ liệu

class Lop {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllLop() {
        // JOIN để lấy tên bộ môn từ bảng bomon
        $query = "SELECT lop.lop_id, lop.ten_lop, bomon.ten_bomon 
                  FROM lop 
                  INNER JOIN bomon ON lop.bomon_id = bomon.bomon_id";

        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute();

        // Lấy dữ liệu sử dụng MySQLi
        $result = $stmt->get_result();
        $lopList = [];
        while ($row = $result->fetch_assoc()) {
            $lopList[] = $row;
        }
        return $lopList;
    }
}
?>