<?php
include_once('config.php');
//Ko hieu sao co header roi ma van khai bao lan nua moi nhan bien $con
$con = mysqli_connect($db_host,$db_username,$db_password,$db_database);

// Check kết nối
if (mysqli_connect_errno($con))
{
  echo "Lỗi kết nối CSDL: " . mysqli_connect_error();
  die('Không thể kết nối tới CSDL');
}

// Khai báo biến ban đầu
$new_rule = "";
$new_rule_short = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//Bat loi nhap input
   if (empty($_POST["new_rule"]) || empty($_POST["new_rule_short"]))
     {$nameErr = "Xin hãy nhập luật vào";header('location:rules.php');}
   else
    {
		$new_rule = kiemtradauvao($_POST["new_rule"]);
		$new_rule_short = kiemtradauvao($_POST["new_rule_short"]);
	}
		
}
	//Kiem tra trugn lap luat
if(!kiemtraluat($con, $new_rule_short)){
	themluat($con, $new_rule_short, $new_rule);
	header('location:rules.php');
}
else{
	die("Sự kiện \"$new_rule\" đã tồn tại!");
}
//tach du lieu dao vao thanh kieu F1.F2:F3
function kiemtradauvao($data)
{
	if(($data == "") || ($data == " ") || ($data == "  ") || empty($data)){	
		die('Ok chưa?');	
		header('location:rules.php');
	}
     $data = trim($data); //xoa khoang trang
     $data = stripslashes($data);
	 $data = htmlspecialchars($data);
	 $data = str_replace("+", "", $data); //xoa dau +
     return $data;
}
//ham kiem tra luat
function kiemtraluat($con, $new_rule_short)
{
	$query = "SELECT rule_short FROM tapluat WHERE rule='$new_rule_short'";
	$result = mysqli_query($con, $query);
	if(!$result)
		 die("Không tìm thấy bảng");
	else{
		if($result->num_rows > 0)
			return TRUE;
		else
			return FALSE;
	}
		
}
//them luat vao db
function themluat($con, $new_rule_short, $new_rule)
{
	$temp = demluat($con) + 1; //tao chi so
	$rule_index = "R".$temp;
	$result = mysqli_query($con,"INSERT INTO tapluat (rule_index, rule, rule_short) VALUES ('$rule_index', '$new_rule', '$new_rule_short')");
	if(!$result)
		return FALSE;
	else
		return TRUE;
}
// dem luat de tao chi so
function demluat($con)
{
	$result = mysqli_query($con,"SELECT * FROM tapluat");
	if(!$result)
		 die("Không tìm thấy bảng");
	else{
		return $result->num_rows;
	}
		
}
//Import tap luat tu CSDL vao txt - test
$myfile = fopen("rules.txt", "w") or die("Không thể mở file!");
$query = "SELECT rule_short FROM tapluat";
$result = mysqli_query($connection, $query);

    if (!$result)
        die("Không tìm thấy bảng CSDL");
    else {
        if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $txt = $row['rule_short']."\n";
                    fwrite($myfile, $txt);
                }         
}
        }
mysqli_close($con);
?>