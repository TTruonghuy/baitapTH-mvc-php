
<?php
require_once 'database_connect.php'; // Kết nối cơ sở dữ liệu

class GiaoVien {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllGiaoVien() {
        // JOIN để lấy tên bộ môn từ bảng bomon
        $query = "SELECT giaovien.giaovien_id, giaovien.ho_ten, giaovien.ngay_sinh, giaovien.gioi_tinh, bomon.ten_bomon
                  FROM giaovien 
                  INNER JOIN bomon ON giaovien.bomon_id = bomon.bomon_id";

        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute();

        // Lấy dữ liệu sử dụng MySQLi
        $result = $stmt->get_result();
        $giaovienList = [];
        while ($row = $result->fetch_assoc()) {
            $giaovienList[] = $row;
        }
        return $giaovienList;
    }
}
?>