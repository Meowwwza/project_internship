<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="restyle.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Home Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .header {
            max-width: 600px;
            text-align: center;
            padding: 20px;
            background-color: #2196F3;
            color: white;
            width: 100%;
            box-sizing: border-box;
        }

        .content {
            max-width: 600px;
            width: 100%;
            text-align: center;
            padding: 20px;
            margin: 0px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        .success {
            background: #c8e6c9;
            color: #388e3c;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        p {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        @media (max-width: 768px) {
            .header {
                font-size: 24px;
                padding: 15px;
            }

            .content {
                padding: 15px;
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .header {
                font-size: 18px;
                padding: 10px;
            }

            .content {
                padding: 10px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>หน้าโฮม</h1>
    </div>

    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) :  ?>
            <h3>ยินดีต้อนรับคุณ <strong><?php echo $_SESSION['username']; ?></strong></h3>
            <p><a href="../index.php" style="color: blue;">เข้าสู่หน้าแรก</a></p>
            <p><a href="home.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
        <?php endif ?>
    </div>
</body>

</html>
