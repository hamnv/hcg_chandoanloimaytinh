<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "suydientien";

$connection = mysqli_connect($db_host,$db_username,$db_password,$db_database);
if (!$connection){
    die("Lỗi không thể kết nối tới CSDL" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'suydientien');
if (!$select_db){
    die("Chọn CSDL thất bại" . mysqli_error($connection));
}
?>