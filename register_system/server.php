<?php
    // session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pc_website";

    //create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //check connection
    if (!$conn) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว : " . mysqli_connect_error($conn));
    }
    else {
        mysqli_set_charset($conn, 'utf8');
        //echo "Connected successfully";
    }
?>




