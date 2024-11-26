<?php
require_once 'database_connect.php'; // Include file Database.php
class User
{
    private $db; // Thuộc tính để lưu đối tượng kết nối cơ sở dữ liệu
    public function __construct()
    {
        // Khởi tạo đối tượng Database và kết nối CSDL
        $database = new Database();
        $this->db = $database->connect();
    }
    public function checkUser($userData = array())
    {
        if (!empty($userData)) {
            // Kiểm tra nếu oauth_uid và oauth_provider không null
            if (empty($userData['oauth_uid']) || empty($userData['oauth_provider'])) {
                return null;  // Nếu thiếu thông tin bắt buộc, trả về null
            }
            // Kiểm tra xem user đã tồn tại trong CSDL chưa
            $query = "SELECT * FROM users WHERE oauth_provider = ? AND oauth_uid = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ss', $userData['oauth_provider'], $userData['oauth_uid']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Nếu tồn tại, cập nhật dữ liệu user
                $query = "UPDATE users SET name = ?, username = ?, email = ?,  picture = ?, link = ?, status = 'active', modified = NOW() WHERE oauth_provider = ? AND oauth_uid = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param(
                    'sssssss',
                    $userData['name'],
                    $userData['username'],
                    $userData['email'],
                    $userData['picture'],
                    $userData['link'],
                    $userData['oauth_provider'],
                    $userData['oauth_uid']
                );
                $stmt->execute();
            } else {
                // Nếu chưa tồn tại, thêm mới user vào CSDL
                $query = "INSERT INTO users (oauth_provider, oauth_uid, name, username, email, picture, link, status, created, modified) VALUES (?, ?, ?, ?, ?, ?, ?, 'active', NOW(), NOW())";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param(
                    'sssssss',
                    $userData['oauth_provider'],
                    $userData['oauth_uid'],
                    $userData['name'],
                    $userData['username'],
                    $userData['email'],
                    $userData['picture'],
                    $userData['link']
                );
                $stmt->execute();
            }
            // Lấy thông tin user từ CSDL sau khi cập nhật/thêm mới
            $stmt = $this->db->prepare("SELECT * FROM users WHERE oauth_provider = ? AND oauth_uid = ?");
            $stmt->bind_param('ss', $userData['oauth_provider'], $userData['oauth_uid']);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
        }
        // Trả về thông tin user
        return $userData;
    }

    public function register($email, $password, $name = '', $username = '', $picture = '') {
        // Thiết lập URL ảnh đại diện mặc định nếu không có
        if (empty($picture)) {
            $picture = 'https://example.com/default-avatar.png'; // URL ảnh mặc định
        }
    
        // Kiểm tra xem email đã tồn tại chưa
        $query = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            return ['success' => false, 'message' => 'Email đã tồn tại.'];
        }
    
        // Mã hóa mật khẩu và thêm người dùng mới
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (email, password, name, username, picture, status, created, modified) 
                  VALUES (?, ?, ?, ?, ?, 'active', NOW(), NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $email, $hashedPassword, $name, $username, $picture);
        $success = $stmt->execute();
    
        if ($success) {
            $_SESSION['success_message'] = 'Đăng ký thành công.';
        } else {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi đăng ký.';
        }
    }
    public function findUserByEmail($email)
{
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc(); // Trả về thông tin người dùng nếu tìm thấy
}
    
}
