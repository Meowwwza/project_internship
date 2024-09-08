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
            background-color: white;
        }

        .header-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 70px;
            height: 50px;
            border-radius: 8px;
        }

        .menu-items {
            display: flex;
            align-items: center;
        }

        .menu-items a {
            margin-left: 10px;
        }

        .dropdown-click {
            position: relative;
        }

        .dropdown-click img {
            cursor: pointer;
            width: 40px;
            height: 40px;
        }

        .dropdown-content {
            position: absolute;
            top: 50px;
            right: 0;
            display: none;
            z-index: 1;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content div {
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .dropdown-content div img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .dropdown-content a {
            padding: 10px;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            .menu-items {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }

            .menu-items a {
                margin-left: 0;
                margin-top: 5px;
            }

            .dropdown-click {
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>
    <header class="w3-bar w3-card-2 w3-blue header-container">
        <a href="./index.php" class="w3-bar-item w3-button w3-hover-blue logo">
            <img src="./pic/poompc_edited2.jpg" alt="PoomPC">
        </a>
        <div class="menu-items">
            <a href="./index.php" class="w3-bar-item w3-button w3-hover-indigo">
                <h3>หาพนักงาน</h3>
            </a>
            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin')) : ?>
                <a href="./post.php" class="w3-bar-item w3-button w3-hover-indigo">
                    <h3>โพสต์งาน</h3>
                </a>
                <a href="./my_posts.php" class="w3-bar-item w3-button w3-hover-indigo">
                    <h3>งานของฉัน</h3>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin')) : ?>
                <a href="./admin.php" class="w3-bar-item w3-button w3-hover-indigo">
                    <h3>จัดการโพสต์พนักงาน</h3>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                <div class="w3-dropdown-click dropdown-click">
                    <div class="w3-hover-indigo">
                        <img src="./pic/profile.svg" class="w3-circle" alt="profile" onclick="toggleDropdown()">
                    </div>
                    <div id="profileDropdown" class="w3-dropdown-content w3-bar-block w3-round-large">
                        <div>
                            <img src="./pic/profile.svg" class="w3-circle" alt="profile">
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
            if (dropdown.style.display === "none" || dropdown.style.display === "") {
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
</body>

</html>
