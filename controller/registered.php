<?php
require_once '../model/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Kiểm tra các trường bắt buộc
    if (empty($name) || empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin!']);
        exit;
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu
    if ($password !== $confirmPassword) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu và xác nhận mật khẩu không khớp!']);
        exit;
    }

    // Xử lý ảnh đại diện
    $picture = '';
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        // Đặt thư mục lưu trữ ảnh
        $targetDir = "../public/avt_user/"; // Thư mục chứa ảnh đại diện
        $fileName = basename($_FILES["picture"]["name"]); // Lấy tên tệp ảnh
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Lấy phần mở rộng của file

        // Đổi tên file ảnh bằng cách thêm thời gian hiện tại và một ID duy nhất
        $newFileName = time() . '_' . uniqid() . '.' . $fileExtension;
        $targetFile = $targetDir . $newFileName; // Đường dẫn file mới

        // Kiểm tra loại file (ảnh)
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($fileExtension, $allowedTypes)) {
            echo json_encode(['status' => 'error', 'message' => 'Chỉ hỗ trợ các định dạng ảnh JPG, PNG, JPEG, GIF!']);
            exit;
        }

        // Di chuyển ảnh vào thư mục đích
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
            $picture = $newFileName; // Lưu tên mới của ảnh
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Đã xảy ra lỗi khi tải ảnh lên.']);
            exit;
        }
    }

    // Mã hóa mật khẩu
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Dữ liệu người dùng
    $userData = [
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'picture' => $picture,  // Lưu tên file ảnh
        'status' => 'active',
        'created' => date('Y-m-d H:i:s'),
        'modified' => date('Y-m-d H:i:s')
    ];
    $email = $userData['email'];
    $name = $userData['name'];
    $username = $userData['username'];
    $picture = $userData['picture'] ?? '';

    // Gọi Model User để tạo tài khoản mới
    $userModel = new User();
    $result = $userModel->register($email, $password, $name, $username, $picture);

    //if ($result['success']) {
       // echo "<script>alert('Đăng ký thành công!');</script>";
       // include "../view/home.php"; // Sử dụng đường dẫn tương đối tới view
       // exit();
    //} 
   //else { 
   //     echo "<script>alert('Đăng ký thất bại!');</script>";
    //    echo "<script>window.location.href = '../view/home.php';</script>";
     //   exit();
   // }
}