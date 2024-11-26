<?php
class Database
{
    private $conn = NULL; // Kết nối cơ sở dữ liệu
    private $server = 'localhost'; // Tên máy chủ
    private $dbName = 'baitap';    // Tên cơ sở dữ liệu
    private $user = 'root';        // Tên người dùng
    private $password = '';        // Mật khẩu

    // Hàm kết nối CSDL
    public function connect()
    {
        $this->conn = new mysqli($this->server, $this->user, $this->password, $this->dbName);
        if ($this->conn->connect_error) {
            die('Failed to connect with MySQL: ' . $this->conn->connect_error);
        }
        return $this->conn; // Trả về đối tượng kết nối
    }

    // Hàm đóng kết nối CSDL
    public function closeDatabase()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
