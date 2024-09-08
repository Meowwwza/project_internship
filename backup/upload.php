<?php
session_start();
include_once('../register_system/server.php');

if (isset($_POST['post'])) {
    // Debugging $_POST
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    
    // ตรวจสอบว่ามีการส่ง idUser มาหรือไม่
    if(isset($_POST['idUser'])) {
        $idUser = $_POST['idUser']; // รับค่า idUser ของผู้ใช้จากฟอร์ม
    } else {
        echo "ไม่พบ idUser";
        exit;
    }

    $idCategory = $_POST['idCategory'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $target_dir = "uploads/";

    // ตรวจสอบและสร้างโฟลเดอร์ถ้ายังไม่มี
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_count = count($_FILES['pimage']['name']);
    $uploaded_files = [];

    // อัปโหลดไฟล์
    for ($i = 0; $i < $file_count; $i++) {
        $target_file = $target_dir . basename($_FILES["pimage"]["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ตรวจสอบว่าเป็นไฟล์รูปภาพจริงหรือไม่
        $check = getimagesize($_FILES["pimage"]["tmp_name"][$i]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "ไฟล์ " . basename($_FILES["pimage"]["name"][$i]) . " ไม่ใช่รูปภาพ.<br>";
            $uploadOk = 0;
        }

        // ตรวจสอบขนาดไฟล์ (ตัวอย่างจำกัดที่ 5MB)
        if ($_FILES["pimage"]["size"][$i] > 5000000) {
            echo "ไฟล์ " . basename($_FILES["pimage"]["name"][$i]) . " มีขนาดใหญ่เกินไป.<br>";
            $uploadOk = 0;
        }

        // อนุญาตเฉพาะไฟล์รูปภาพบางประเภท
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "ขออภัย, อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้น.<br>";
            $uploadOk = 0;
        }

        // ตรวจสอบว่าพร้อมอัปโหลดไฟล์หรือไม่
        if ($uploadOk == 0) {
            echo "ขออภัย, ไฟล์ของคุณไม่ได้รับการอัปโหลด.<br>";
            header("location:../post.php");
        } else {
            if (move_uploaded_file($_FILES["pimage"]["tmp_name"][$i], $target_file)) {
                $uploaded_files[] = basename($_FILES["pimage"]["name"][$i]);
                echo "ไฟล์ " . basename($_FILES["pimage"]["name"][$i]) . " ได้รับการอัปโหลดเรียบร้อยแล้ว.<br>";
                header("location:../post.php");
            } else {
                echo "ขออภัย, เกิดข้อผิดพลาดในการอัปโหลดไฟล์ " . basename($_FILES["pimage"]["name"][$i]) . ".<br>";
                header("location:../post.php");
            }
        }
    }

    // ตรวจสอบว่าผู้ใช้มีอยู่ในตาราง user
    $user_check_query = "SELECT idUser FROM user WHERE idUser='$idUser' LIMIT 1";
    $result = $conn->query($user_check_query);
    if ($result->num_rows == 0) {
        echo "ไม่พบผู้ใช้ในฐานข้อมูล";
        exit;
    }

    // เก็บชื่อไฟล์ที่อัปโหลดลงในฐานข้อมูล
    if (!empty($uploaded_files)) {
        $pimage = implode(',', $uploaded_files); // แปลงอาร์เรย์เป็นสตริงที่คั่นด้วยเครื่องหมายจุลภาค

        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO post (idUser, idCategory, pimage, detail, price, location) VALUES ('$idUser', '$idCategory', '$pimage', '$detail', '$price', '$location')";

        if ($conn->query($sql) === TRUE) {
            echo "ข้อมูลได้รับการบันทึกลงในฐานข้อมูลเรียบร้อยแล้ว";
            header("location:../post.php");
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
            header("location:../post.php");
        }
    }
}

$conn->close();
?>
