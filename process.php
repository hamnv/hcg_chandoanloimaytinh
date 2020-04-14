<?php
include_once('config.php');
include_once('header.php');
//bat loi
GLOBAL $sukien;
if (empty($_GET['sukien'])) {
    $_POST['sukien'] = " Bạn chưa chọn gì cả !";
    header('location:index.php');
} else
    $sukien = $_GET['sukien'];
//sinh to hop
$new_array = array();
foreach ($sukien as $key => $val) {
    foreach ($sukien as $key2 => $val2) {
        if ($key2 <= $key) continue;
        $new_array[] = $val . '.' . $val2;
    }
}
//print_r($new_array);
//////*****ket thuc sinh to hop */
$tohop = array_merge($sukien, $new_array);

?>

<body>
    <section id="wrap">
        <section id="main">
            <div class="container">
                <div class="card" style="width:56%;cursor:default;">
                    <h3> Các triệu chứng đã chọn: </h3>
                    <hr>
                    <?php
                    //Cac gia thiet ban dau
                    foreach ($sukien as $sk) {
                        $query2 = "SELECT fact FROM sukien where fact_index = '$sk' ";
                        $result2 = mysqli_query($connection, $query2);
                        if ($result2->num_rows > 0) {
                            while ($row2 = mysqli_fetch_array($result2)) {
                                ?>

                                <p><b> <?php echo $row2['fact'];
                                                }
                                            }
                                        } ?></b></p>
                </div>
                <div class="card green button submit" style="width:21%;margin-left:1%;">
                    <a href="admin.php">
                        <p>Giải thích</p>
                    </a>
                </div>
            </div>
            <div class="clear"></div>
            <div class="container">

            </div>
            <div class="container">
                <h2 style="color:#ffffff;margin-bottom:0px;">&#9655; Lỗi được xác định là do:</h2>

                <?php foreach ($tohop as $sk) { //Vogn lap tung sk
                    // Truy van lay tap luat phu hop
                    //Loc nhung luat ma co ve trai = gia thiet ban dau
                    $query = "SELECT rule_short FROM tapluat where rule_short LIKE '" . $sk . ":" . "%' ";
                    $result = mysqli_query($connection, $query);
                    $ketluan = "";
                    if (!$result)
                        die("Không tìm thấy bảng CSDL");
                    else {
                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<h1 style=\"color:#ffffff;margin-bottom:0px;\"\>";
                                $tap_gt_moi = explode(":", $row['rule_short']);
                                $gt_moi = $tap_gt_moi[1];
                                if (!in_array($gt_moi, $sukien)) {
                                    $sukien[] = $tap_gt_moi[1]; //bo sung su kien vao bo nho ban dau

                                    $ketluan .= $gt_moi . "+"; //phat bieu
                                }


                                // print_r($sukien);

                                /*
                    $query2 = "SELECT rule_short FROM tapluat where rule_short LIKE '".$gt_moi.":"."%' ";
                    $result2 = mysqli_query($connection, $query2);
                    if (!$result2)
                             die("Không tìm thấy bảng CSDL");
                     else {
                         if ($result2->num_rows > 0) {
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $row2['rule_short'];
                                var_dump($row2);
                            }
                        }
                    }*/
                            } //lap ban ghi
                        } //tim thay kq db
                        // echo $ketluan;
                        $tap_ket_qua = explode("+", $ketluan);
                        foreach ($tap_ket_qua as $kq) {
                            $truyvan_ketqua = "SELECT fact FROM sukien where fact_index = '$kq' and final_fact = '1' ";
                            $thuchien =  mysqli_query($connection, $truyvan_ketqua);
                            if (!$result)
                                die("Không tìm thấy bảng CSDL");
                            else {
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_array($thuchien)) {
                                        echo $row['fact'] . "<br>";
                                    }
                                }
                            }
                        }
                    }

                    echo "</h1>";
                } //vong lap foreach $sukien





                ?>

            </div>