<?php
$title = "ตั้งค่าโปรไฟล์";
include 'header.php';
include './register_system/server.php';

if (!isset($_SESSION['idUser'])) {
    header('Location: login.php');
    exit;
}

$idUser = $_SESSION['idUser'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT * FROM user WHERE idUser = $idUser";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nickname = $_POST['nickname'];
    $experience = $_POST['experience'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // อัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
    $sql = "UPDATE user SET nickname='$nickname', experience='$experience', email='$email', phone='$phone' WHERE idUser = $idUser";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "อัปเดตโปรไฟล์เรียบร้อยแล้ว";
        header('Location: profile_settings.php');
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดต: " . $conn->error;
    }
}
?>

<style>
    .profile-container {
        margin-left: auto;
        margin-right: auto;
        padding: 16px;
        max-width: 800px;
    }

    .w3-section label {
        display: block;
        margin-bottom: 8px;
    }

    .w3-section input,
    .w3-section textarea {
        width: 100%;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 16px;
        }

        .w3-section input,
        .w3-section textarea {
            font-size: 14px;
        }

        .w3-btn {
            width: 100%;
            margin-top: 16px;
        }
    }
</style>

<div class="w3-container profile-container" style="min-height:85vh;">
    <h1 style="color:#2196F3">ตั้งค่าโปรไฟล์</h1>
    <?php
    if (isset($_SESSION['success'])) {
        echo "<div class='w3-panel w3-green w3-display-container'>
                <span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-green w3-large w3-display-topright'>&times;</span>
                <h3>สำเร็จ!</h3>
                <p>" . $_SESSION['success'] . "</p>
              </div>";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        echo "<div class='w3-panel w3-red w3-display-container'>
                <span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-red w3-large w3-display-topright'>&times;</span>
                <h3>ผิดพลาด!</h3>
                <p>" . $_SESSION['error'] . "</p>
              </div>";
        unset($_SESSION['error']);
    }
    ?>
    <form method="post" action="">
        <div class="w3-section">
            <label>ชื่อ</label>
            <input class="w3-input w3-border w3-round" type="text" name="firstname" value="<?php echo $user['firstname']; ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <div class="w3-section">
            <label>นามสกุล</label>
            <input class="w3-input w3-border w3-round" type="text" name="lastname" value="<?php echo $user['lastname']; ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <div class="w3-section">
            <label>ชื่อเล่น</label>
            <p style="color: red; margin:0px; padding:0px;">*จะแสดงในรายละเอียดโพสต์</p>
            <input class="w3-input w3-border w3-round" type="text" name="nickname" value="<?php echo $user['nickname']; ?>" required>
        </div>
        <div class="w3-section">
            <label>ประสบการณ์</label>
            <textarea class="w3-input w3-border w3-round" name="experience" required><?php echo $user['experience']; ?></textarea>
        </div>
        <div class="w3-section">
            <label>อีเมล</label>
            <input class="w3-input w3-border w3-round" type="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="w3-section">
            <label>เบอร์โทรศัพท์</label>
            <input class="w3-input w3-border w3-round" type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
        </div>
        <button type="submit" class="w3-btn w3-blue w3-round">บันทึกการเปลี่ยนแปลง</button>
    </form>
</div>

<?php include 'footer.php'; ?>
