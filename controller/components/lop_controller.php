<?php
require_once '../model/lop.php';

class LopController {
    private $lopModel;

    public function __construct() {
        $this->lopModel = new Lop();
    }

    public function getAllLop() {
        return $this->lopModel->getAllLop();
    }
}
?>
