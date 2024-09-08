<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $title; ?></title>
    <style>
        body {
            background-color:  white;
        }
    </style>

</head>

<body>
    <header class="w3-bar  w3-card-2 w3-blue">
        <a href="./index.php" class="w3-bar-item w3-button w3-hover-blue">
            <img src="./pic/poompc_edited2.jpg" class="w3-round" alt="PoomPC" style="margin:0px; width: 70px; height: 50px;">
        </a>
        <div class="w3-right">
            <a href="./index.php" class="w3-bar-item w3-button w3-hover-indigo">
                <h3>หาพนักงาน</h3>
            </a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user' || isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                <a href="./post.php" class="w3-bar-item w3-button w3-hover-indigo">
                    <h3>โพสต์งาน</h3>
                </a>
                <a href="./my_posts.php" class="w3-bar-item w3-button w3-hover-indigo">
                    <h3>งานของฉัน</h3>
                </a>
            <?php endif; ?>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                <div class="w3-dropdown-click">
                    <div class="w3-hover-indigo">
                        <img src="./pic/profile.svg" class="w3-circle" alt="profile" style="margin: 5px; width:auto; height:auto;" onclick="toggleDropdown()">
                    </div>
                    <div id="profileDropdown" class="w3-dropdown-content w3-bar-block w3-border w3-round-large" style="display: none;">
                        <div>
                            <img src="./pic/profile.svg" class="w3-circle" alt="profile" style="margin: 5px; width:auto; height:auto;" onclick="toggleDropdown()">
                            <span id="username"><strong><?php echo $_SESSION['username']; ?></strong></span>
                        </div>
                        <a href="./profile_settings.php" class="w3-bar-item w3-button">ตั้งค่าโปรไฟล์</a>
                        <a href="./register_system/logout.php" class="w3-bar-item w3-button" style="color: red;">ออกจากระบบ</a>
                    </div>
                </div>
            <?php else : ?>
                <a href="./register_system/login.php" class="w3-bar-item w3-button w3-hover-indigo">
                    <h3>เข้าสู่ระบบ</h3>
                </a>
            <?php endif; ?>
        </div>
    </header>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("profileDropdown");
            if (dropdown.style.display === "none") {
                dropdown.style.display = "block";
            } else {
                dropdown.style.display = "none";
            }
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.w3-dropdown-click img')) {
                var dropdowns = document.getElementsByClassName("w3-dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>