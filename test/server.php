<?php
$servername = "localhost";
$username = "u825045991_PoomPC";
$password = "M>clGi822P*PTS";
$dbname = "u825045991_PoomPC";

// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว : " . mysqli_connect_error());
} else {
    //echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
}
?>
