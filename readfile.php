<?php 
//test doc file
$myFile = "rules.txt";
$lines = file($myFile);//file in to an array
$mang = "";
foreach($lines as $ln) {
    $chiave = explode(":",$ln);
    $i=0;
    $mang .= $chiave[$i];
    $mang .= "<br>";
    $i++;
    //print_r($chiave);

}
echo $mang;
?>