<?php
require_once 'model/database_connect.php';
//require_once 'controller/components/home_controller.php';
$db = new database;
$db->connect();
//$controller = new HomeController();
//$controller->index();
/*Xử lý các request*/
$db->closeDatabase();
header("Location: view/home.php");
exit();
?>