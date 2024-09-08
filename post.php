<?php
$title = "โพสต์งาน";
include('header.php');
include('./register_system/server.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบว่าผู้ใช้ล็อกอินแล้วหรือไม่
if (isset($_SESSION['idUser']) && $_SESSION['idUser'] != null) {
    $idUser = $_SESSION['idUser'];
} else {
    echo "กรุณาเข้าสู่ระบบก่อนโพสต์งาน";
    exit;
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sqlUser = "SELECT * FROM user WHERE idUser = $idUser";
$resultUser = $conn->query($sqlUser);

if ($resultUser->num_rows > 0) {
    $user = $resultUser->fetch_assoc();
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit;
}
?>

<style>
.post-container {
    margin: 0 auto;
    padding: 20px;
    max-width: 800px;
}

form.w3-container {
    width: 100%;
}

.w3-section {
    width: 100%;
    margin-bottom: 20px;
}

.w3-input, .w3-select, textarea {
    width: 100%;
    box-sizing: border-box;
}

.w3-btn {
    width: 100%;
}

@media (max-width: 768px) {
    .post-container {
        padding: 10px;
    }
}

@media (max-width: 480px) {
    .post-container {
        padding: 5px;
    }
}
</style>

<div class="w3-container post-container">
    <form class="w3-container" action="upload_system/upload.php" method="post" enctype="multipart/form-data">
        <h1 style="color:#2196F3;">โพสต์งาน</h1>

        <div class="w3-section">
            <label>ชื่อ</label>
            <input class="w3-input w3-border w3-round" type="text" name="firstname" value="<?php echo $user['firstname'] ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <div class="w3-section">
            <label>นามสกุล</label>
            <input class="w3-input w3-border w3-round" type="text" name="lastname" value="<?php echo $user['lastname'] ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <div class="w3-section">
            <label>ชื่อเล่น</label>
            <p style="color: red; margin:0px; padding:0px;">*จะแสดงในรายละเอียดโพสต์</p>
            <input class="w3-input w3-border w3-round" type="text" name="nickname" value="<?php echo $user['nickname']; ?>" readonly style="pointer-events: none; color:gray;">
        </div>

        <input type='hidden' name='idUser' value='<?php echo $idUser; ?>'>

        <div class="w3-section">
            <label>หมวดหมู่ของงาน</label>
            <select class="w3-select w3-border w3-round" name="idCategory" required>
                <option value="" disabled selected>เลือกหมวดหมู่ของงาน</option>
                <?php
                $sql = "SELECT idCategory, category FROM category";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["idCategory"] . '">' . $row["category"] . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>ไม่มีหมวดหมู่ให้เลือก</option>';
                }
                ?>
            </select>
        </div>

        <div class="w3-section">
            <label>อัปโหลดรูปภาพ</label>
            <p style="color: red; margin:0px; padding:0px;">*รองรับเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้น</p>
            <input type="file" name="pimage[]" class="w3-input w3-border w3-round" multiple required>
        </div>

        <div class="w3-section">
            <label>ชื่อโพสต์</label>
            <input type="text" name="head" class="w3-input w3-border w3-round" maxlength="100" required>
        </div>

        <div class="w3-section">
            <label>คำอธิบายงาน</label>
            <p style="color: red; margin:0px; padding:0px;">*ห้ามใส่ข้อมูลติดต่อ(contact)โดยเด็ดขาด</p>
            <textarea name="detail" class="w3-input w3-border w3-round" rows="5" required></textarea>
        </div>

        <div class="w3-section">
            <label>ราคาแพคเกจ</label>
            <input type="number" name="price" class="w3-input w3-border w3-round" required>
        </div>

        <div class="w3-section">
            <label>ขอบเขตสถานที่</label>
            <input type="text" name="location" class="w3-input w3-border w3-round" required>
        </div>

        <div class="input-group">
            <button type="submit" name="post" class="w3-btn w3-blue w3-margin-top w3-round-large">โพสต์</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
