<?php
include('server.php');
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="restyle.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>เข้าสู่ระบบ</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            padding: 20px;
        }

        form {
            /* width: 300px; */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: #f9f9f9;
        }

        .input-group {
            margin: 10px 0;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2196F3;
        }

        .error {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
            border-radius: 5px;
            text-align: center;
        }

        p {
            text-align: center;
        }

        a {
            color: #2196F3;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            form,.header {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            form,.header {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>เข้าสู่ระบบ</h2>
    </div>
    <form action="login_db.php" method="post">
        <!-- notification message -->
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class="input-group">
            <label for="username">ชื่อผู้ใช้</label>
            <input type="text" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password" required>
        </div>
        <div class="input-group">
            <button type="submit" name="login_user" class="btn">เข้าสู่ระบบ</button>
        </div>
        <p>ยังไม่มีบัญชี ? <a href="register.php">สร้างบัญชี</a></p>
    </form>

</body>

</html>
