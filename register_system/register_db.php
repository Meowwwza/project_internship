<?php
    session_start();
    include('server.php');
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']); // mysqli_real_escape_string คือการไม่ให้userใส่ตัวอักษรพิเศษ
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']); // $_POST['name'] คือ nameที่อยู่ใน<input>
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);

        if (empty($username)) { // ถ้าไม่ได้ใส่ username
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }

        $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { // ถ้ามีuser อยู่ในระบบ
            if ($result['username'] === $username) {
                array_push($errors, "Username already exists");
            }
            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");
            }
        }

        if (count($errors) == 0) {
            $password = md5($password_1);
            $role = 'user'; // กำหนด role เป็น 'user'

            $sql = "INSERT INTO user (username, email, password, phone ,firstname, lastname, nickname, role) VALUES ('$username', '$email', '$password', '$phone' ,'$firstname', '$lastname', '$nickname', '$role')";
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "คุณเข้าสู่ระบบเรียบร้อยแล้ว";
            header('location: home.php');
        }
    }

?>