
<?php
require_once 'database_connect.php'; // Kết nối cơ sở dữ liệu

class SinhVien {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllSinhVien() {
        // JOIN để lấy tên bộ môn từ bảng bomon
        $query = "SELECT sinhvien.sinhvien_id, sinhvien.ho_ten, sinhvien.ngay_sinh, sinhvien.gioi_tinh, lop.ten_lop
                  FROM sinhvien 
                  INNER JOIN lop ON sinhvien.lop_id = lop.lop_id";

        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute();

        // Lấy dữ liệu sử dụng MySQLi
        $result = $stmt->get_result();
        $sinhvienList = [];
        while ($row = $result->fetch_assoc()) {
            $sinhvienList[] = $row;
        }
        return $sinhvienList;
    }
}
?>