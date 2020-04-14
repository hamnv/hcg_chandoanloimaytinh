<?php 
include_once('config.php'); 
$con = mysqli_connect($db_host,$db_username,$db_password,$db_database);


if (mysqli_connect_errno($con))
{
  echo "Không thể kết nối tới CSDL: " . mysqli_connect_error();
  die('Lỗi');
}

?>
<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="robots" content="noindex, nofollow" />
        <title> Hệ chuyên gia chẩn đoán lỗi Máy tính </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        
		<script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>