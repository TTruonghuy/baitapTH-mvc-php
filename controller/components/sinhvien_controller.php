<?php
require_once '../model/sinhvien.php';

class SinhVienController {
    private $sinhvienModel;

    public function __construct() {
        $this->sinhvienModel = new SinhVien();
    }

    public function getAllSinhVien() {
        return $this->sinhvienModel->getAllSinhVien();
    }
}
?>
