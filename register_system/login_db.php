<?php
session_start();
include('server.php');
$errors = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "ชื่อผู้ใช้จำเป็นต้องกรอก");
    }

    if (empty($password)) {
        array_push($errors, "รหัสผ่านจำเป็นต้องกรอก");
    }
    
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role']; // ดึงข้อมูล role จากฐานข้อมูล
            $_SESSION['idUser'] = $user['idUser']; // ดึงข้อมูลidUser จากฐานข้อมูล
            $_SESSION['loggedin'] = true;
            $_SESSION['success'] = "คุณเข้าสู่ระบบสำเร็จ";
            unset($_SESSION['error']); // ลบ error ถ้ามี
            header('location: home.php');
        } else {
            array_push($errors, "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง โปรดลองอีกครั้ง!";
            header('location: login.php');
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('location: login.php');
    }
}
?>
