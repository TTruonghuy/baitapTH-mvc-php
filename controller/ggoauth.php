<?php
// Initialize the session
session_start();

// Update the following variables
$google_oauth_client_id = '39135302522-rvo6utdccr681pap0gj57qcd34ilepus.apps.googleusercontent.com';
$google_oauth_client_secret = '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';
$google_oauth_redirect_uri = 'http://localhost/Newfolder/controller/ggoauth.php';
$google_oauth_version = 'v3';

// Kiểm tra nếu mã code được trả về từ Google
if (isset($_GET['code']) && !empty($_GET['code'])) {
    // Thực hiện yêu cầu cURL để lấy access token   
    $params = [
        'code' => $_GET['code'],
        'client_id' => $google_oauth_client_id,
        'client_secret' => $google_oauth_client_secret,
        'redirect_uri' => $google_oauth_redirect_uri,
        'grant_type' => 'authorization_code',
        
    ];

    // Thực hiện yêu cầu cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    // Kiểm tra nếu access token hợp lệ
    if (isset($response['access_token']) && !empty($response['access_token'])) {
        // Thực hiện yêu cầu cURL để lấy thông tin người dùng từ Google
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);
        $profile = json_decode($response, true);

        // Dữ liệu người dùng
        $userData = [
            'oauth_provider' => 'google',
            'oauth_uid' => $profile['sub'] ?? null,
            'name' => $profile['name'] ?? 'Unknown',
            'username' => $profile['given_name'] ?? 'Unknown',
            'email' => $profile['email'] ?? 'Unknown',
            'picture' => $profile['picture'] ?? 'default.jpg',
            'link' => $profile['link'] ?? 'N/A'
        ];
        require_once '../model/user.php';
        $userModel = new User();
        $user = $userModel->checkUser($userData);
        if (!$user) {
            exit('Failed to save user data. Please try again later!');
        }
        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['google_loggedin'] = true;
        $_SESSION['google_picture'] = $profile['picture']; // Lưu ảnh đại diện Google
        $_SESSION['google_name'] = $profile['name'];
        // Chuyển hướng về trang home
        header('Location: ../View/home.php');
        exit;
    } else {
        exit('Invalid access token! Please try again later!');
    }
} else {
    // Define params and redirect to Google Authentication page
    $params = [
        'response_type' => 'code',
        'client_id' => $google_oauth_client_id,
        'redirect_uri' => $google_oauth_redirect_uri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    
    exit;
}
?>
