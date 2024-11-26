<?php
// Bắt đầu session
if (!session_id()) {
    session_start();
}

// Bao gồm thư viện GitHub OAuth
require_once '../libraries/class_gitoauth.php';


// Cấu hình và thiết lập GitHub API
$clientID = 'Ov23liSo1kL8Ydb19zVk'; // Thay thế bằng Client ID của bạn
$clientSecret = 'f0332579437a72594ac2f3dd703804186b944074'; // Thay thế bằng Client Secret của bạn
$redirectURL = 'http://localhost/Newfolder/controller/gitoauth.php'; // Thay thế bằng URL của bạn

// Cấu hình GitHub OAuth Client
$options = [
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'redirect_url' => $redirectURL,
];

try {
    $gitClient = new Github_OAuth_Client ($options);

    // Kiểm tra nếu access token đã có trong session
    if (isset($_SESSION['access_token'])) {
        $accessToken = $_SESSION['access_token'];
    } elseif (isset($_GET['code']) && isset($_GET['state'])) {
        // Nếu code được trả về từ GitHub sau khi đăng nhập thành công
        $state = $_GET['state']; // Kiểm tra state để tránh tấn công CSRF
        $oauthCode = $_GET['code'];

        // Lấy access token từ GitHub
        $accessToken = $gitClient->getAccessToken($state, $oauthCode);

        // Lưu access token vào session
        $_SESSION['access_token'] = $accessToken;
    } else {
        // Nếu chưa có code, chuyển hướng người dùng đến GitHub login page
        $state = bin2hex(random_bytes(16)); // Tạo một state ngẫu nhiên để bảo mật
        $_SESSION['oauth_state'] = $state; // Lưu state vào session
        $authURL = $gitClient->getAuthorizeURL($state);
        header('Location: ' . $authURL);
        exit;
    }

    // Sử dụng access token để lấy thông tin người dùng từ GitHub
    if (isset($accessToken)) {
        $userInfo = $gitClient->apiRequest('user?access_token=' . $accessToken);

        if (!empty($userInfo)) {
            // Tạo dữ liệu người dùng từ GitHub
            $userData = [
                'oauth_provider' => 'github',
                'oauth_uid' => $userInfo->id,
                'name' => $userInfo->name,
                'username' => $userInfo->login, // Tên người dùng GitHub
                'email' => $userInfo->email, // Email GitHub
                'location' => $userInfo->location, // Vị trí
                'picture' => $userInfo->avatar_url, // Ảnh đại diện
                'link' => $userInfo->html_url // Liên kết hồ sơ GitHub
            ];

            // Bao gồm file model và gọi phương thức checkUser để kiểm tra và thêm người dùng vào CSDL
            require_once '../model/user.php';
            $userModel = new User();
            $user = $userModel->checkUser($userData);
            // Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['github_loggedin'] = true;

            // Chuyển hướng về trang home
            header('Location: ../View/home.php');
            exit;
        } else {
            throw new Exception('Không thể lấy thông tin người dùng từ GitHub.');
        }
    }
} catch (Exception $e) {
    echo 'Lỗi: ' . $e->getMessage();
}
