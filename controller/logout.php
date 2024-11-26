<?php
session_start();
session_unset();
session_destroy();
header("Location: ../view/home.php"); // Quay lại trang chính
exit();
?>