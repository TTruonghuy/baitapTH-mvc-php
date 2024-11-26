<?php
require_once '../model/giaovien.php';

class GiaoVienController {
    private $giaovienModel;

    public function __construct() {
        $this->giaovienModel = new GiaoVien();
    }

    public function getAllGiaoVien() {
        return $this->giaovienModel->getAllGiaoVien();
    }
}
?>
