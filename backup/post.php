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

<div class="w3-container" style="margin-left: 200px; min-height:90vh;">

    <form class="w3-container" action="upload_system/upload.php" method="post" enctype="multipart/form-data">
        <h1 style="color:#2196F3;">โพสต์งาน</h1>

        <!-- ข้อมูลผู้ใช้ -->
        <!-- <div class="w3-container w3-border w3-margin-top" style="width: 50%;">
        <p><strong>ชื่อผู้ใช้:</strong> <?php echo $user['username']; ?></p>
        <p><strong>ชื่อ:</strong> <?php echo $user['firstname']; ?></p>
        <p><strong>นามสกุล:</strong> <?php echo $user['lastname']; ?></p>
        <p><strong>ชื่อเล่น:</strong> <?php echo $user['nickname']; ?></p>
        <p><strong>อีเมล:</strong> <?php echo $user['email']; ?></p>
    </div> -->
        <div class="w3-section" style="width: 50%;">
            <label>ชื่อ</label>
            <input class="w3-input w3-border w3-round" type="text" name="firstname" value="<?php
                                                                                    echo $user['firstname'] ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <div class="w3-section" style="width: 50%;">
            <label>นามสกุล</label>
            <input class="w3-input w3-border w3-round" type="text" name="lastname" value="<?php
                                                                                    echo $user['lastname'] ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <div class="w3-section" style="width: 50%;">
            <label>ชื่อเล่น</label>
            <input class="w3-input w3-border w3-round" type="text" name="nickname" value="<?php echo $user['nickname']; ?>" readonly style="pointer-events: none; color:gray;">
        </div>
        <!-- <div class="w3-section" style="width: 50%;">
            <label>ประสบการณ์</label>
            <input class="w3-input w3-border" type="text" name="experience" value="<?php echo $user['experience']; ?>" readonly style="pointer-events: none; color:gray;">
        </div> -->
        <!-- <div class="w3-section" style="width: 50%;">
            <label>อีเมล</label>
            <input class="w3-input w3-border" type="email" name="email" value="<?php echo $user['email']; ?>" readonly style="pointer-events: none; color:gray;">
        </div> -->
        <!-- <div class="w3-section" style="width: 50%;">
            <label>เบอร์โทรศัพท์</label>
            <input class="w3-input w3-border" type="text" name="phone" value="<?php echo $user['phone']; ?>" readonly style="pointer-events: none; color:gray;">
        </div> -->

        <input type='hidden' name='idUser' value='<?php echo $idUser; ?>'>

        <h5 style="margin-bottom: 0px;">หมวดหมู่ของงาน</h5>
        <select class="w3-select w3-border w3-round" name="idCategory" style="width: 50%; margin-bottom:8px;" required>
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
        
        <h5 style="margin-bottom: 0px;">อัปโหลดรูปภาพ</h5>
        <p style="color: red; margin:0px; padding:0px;">*รองรับเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้น</p>
        <input type="file" name="pimage[]" class="w3-input w3-border w3-round" style="width: 50%; margin-bottom:10px;" multiple required>

        <h5 style="margin-bottom: 0px;">ชื่อโพสต์</h5>
        <input type="text" name="head" class="w3-input w3-border w3-round" style="width: 50%; margin-bottom:8px;" maxlength="100" required>

        <h5 style="margin-bottom: 0px;">คำอธิบายงาน</h5>
        <textarea name="detail" class="w3-input w3-border w3-round" style="width: 50%; margin-bottom:8px;" rows="5" required></textarea>

        <h5 style="margin-bottom: 0px;">ราคาแพคเกจ</h5>
        <input type="number" name="price" class="w3-input w3-border w3-round" style="width: 50%; margin-bottom:8px;" required>

        <h5 style="margin-bottom: 0px;">ขอบเขตสถานที่</h5>
        <input type="text" name="location" class="w3-input w3-border w3-round" style="width: 50%; margin-bottom:8px;" required>

        <div class="input-group">
            <button type="submit" name="post" class="w3-btn w3-blue w3-margin-top w3-round-large">โพสต์</button>
        </div>
    </form>

</div>

<?php include 'footer.php'; ?>