<?php
include './register_system/server.php';
session_start();

if (!isset($_SESSION['idUser'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['idPost'])) {
    $idPost = $_GET['idPost'];
    $userId = $_SESSION['idUser'];

    // ลบโพสต์จากฐานข้อมูล
    $sql = "DELETE FROM post WHERE idPost = $idPost AND idUser = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "ลบโพสต์เรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการลบ: " . $conn->error;
    }
}

header('Location: my_posts.php');
?>
