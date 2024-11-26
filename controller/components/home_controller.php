<?php
session_start();
require_once __DIR__ . '/.../model/user.php'; // Gọi Model User

class HomeController {
    public function index() {
        // Kiểm tra người dùng đã đăng nhập chưa
        

        // Lấy thông tin người dùng từ session
        $userAvatar = '';
        if (isset($_SESSION['google_loggedin'])) {
            $userAvatar = $_SESSION['google_picture']; // Ảnh đại diện Google
        } elseif (isset($_SESSION['github_loggedin'])) {
            $userAvatar = $_SESSION['github_picture']; // Ảnh đại diện GitHub
        }

        // Chuyển dữ liệu vào View
        //require_once '../view/home.php'; // Gọi View và truyền dữ liệu vào
    }
}