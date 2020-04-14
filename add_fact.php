<?php
include_once('config.php');
//kHS de cái code nay lam gi du trong header da co nhung van k chạy dc
$con = mysqli_connect($db_host,$db_username,$db_password,$db_database);

// Kiem tra ket noi csdl
if (mysqli_connect_errno($con))
{
  echo "Loi ket noi csdl: " . mysqli_connect_error();
  die('Loi csdl');
}

// khoi tao gia tri rong
$new_fact = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

   if (empty($_POST["new_fact"]))
     {$nameErr = "Xin hãy nhập sự kiện vào";header('location:index.php');}
   else
    {
		$new_fact = test_input($_POST["new_fact"]);
	}
		
}
	
if(!kiemtraSK($con, $new_fact)){

	themSK($con, $new_fact);
	header('location:admin.php');
}
else{
	die("Sự kiện \"$new_fact\" đã tồnt tại");
}

function test_input($data)
{
	if(($data == "") || ($data == " ") || ($data == "  ") || empty($data)){	
		die('Lỗi');	
		header('location:index.php');
	}
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

function kiemtraSK($con, $fact)
{
	$query = "SELECT fact FROM sukien WHERE fact='$fact'";
	$result = mysqli_query($con, $query);
	if(!$result)
		 die("Lỗi kết nối CSDL");
	else{
		if($result->num_rows > 0)
			return TRUE;
		else
			return FALSE;
	}
		
}

function themSK($con, $fact)
{
	$temp = demSK($con) + 1;
	$fact_index = "F".$temp;
	$final_fact = $_POST['final_fact'];
	$fact_level = $_POST['level'];
	$result = mysqli_query($con,"INSERT INTO sukien (fact_index, fact, final_fact, fact_level) VALUES ('$fact_index', '$fact', '$final_fact', '$fact_level')");
	if(!$result)
		return FALSE;
	else
		return TRUE;
}

function demSK($con)
{
	$result = mysqli_query($con,"SELECT * FROM sukien");
	if(!$result)
		 die("Không có bản ghi nào");
	else{
		return $result->num_rows;
	}
		
}


mysqli_close($con);
