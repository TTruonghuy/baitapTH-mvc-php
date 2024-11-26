<?php
session_start();
require_once '../model/user.php';

class LoginController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User(); // Gọi model User
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';


            // Kiểm tra thông tin người dùng trong CSDL
            $user = $this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công
                $_SESSION['user_loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                //$_SESSION['user_picture'] = $user['picture'];
                $_SESSION['success_message'] = 'Đăng nhập thành công!';
                header('Location: ../view/home.php'); // Chuyển hướng đến trang chủ
                exit();
            } else {
                // Sai thông tin đăng nhập
                $_SESSION['error_message'] = 'Email hoặc mật khẩu không đúng.';
                header('Location: ../view/login_view.php');
                exit();
            }
        }
    }

    public function logout()
    {
        // Xóa toàn bộ session và chuyển hướng về trang đăng nhập
        session_destroy();
        header('Location: ../view/login_view.php');
        exit();
    }
}

// Khởi tạo đối tượng LoginController và xử lý yêu cầu
$controller = new LoginController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'login') {
        $controller->login();
    } elseif ($action === 'logout') {
        $controller->logout();
    }
}
?>