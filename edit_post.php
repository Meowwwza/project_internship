<?php
$title = "แก้ไขโพสต์";
include 'header.php';
include './register_system/server.php';

if (!isset($_SESSION['idUser'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['idPost'])) {
    $idPost = $_GET['idPost'];
    $userId = $_SESSION['idUser'];

    // ดึงข้อมูลโพสต์จากฐานข้อมูล
    $sql = "SELECT * FROM post WHERE idPost = $idPost AND idUser = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบโพสต์ที่ต้องการ";
        exit;
    }
} else {
    echo "ไม่พบโพสต์ที่ต้องการ";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $head = $_POST['head'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    // อัปเดตโพสต์ในฐานข้อมูล
    $sql = "UPDATE post SET head='$head', detail='$detail', price='$price', location='$location' WHERE idPost = $idPost AND idUser = $userId";

    if ($conn->query($sql) === TRUE) {
        if (!empty($_FILES['pimage']['name'][0])) {
            // อัปโหลดไฟล์รูปภาพ
            $target_dir = "./upload_system/uploads/";
            $uploaded_files = [];
            foreach ($_FILES['pimage']['name'] as $key => $name) {
                $target_file = $target_dir . basename($name);
                if (move_uploaded_file($_FILES['pimage']['tmp_name'][$key], $target_file)) {
                    $uploaded_files[] = $name;
                }
            }
            if (!empty($uploaded_files)) {
                $pimage = implode(',', $uploaded_files);
                $sql = "UPDATE post SET pimage='$pimage' WHERE idPost = $idPost AND idUser = $userId";
                if ($conn->query($sql) !== TRUE) {
                    $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดตรูปภาพ: " . $conn->error;
                }
            }
        }
        $_SESSION['success'] = "อัปเดตโพสต์เรียบร้อยแล้ว";
        header('location:my_posts.php');
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดต: " . $conn->error;
    }
}
?>

<style>
    .w3-container {
        margin-left: auto;
        margin-right: auto;
        max-width: 800px;
        min-height: 90vh;
        padding: 16px;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .w3-container {
            padding: 8px;
        }
    }

    img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 8px;
    }

    .w3-btn {
        width: 100%;
    }
</style>

<div class="w3-container">
    <h1 style="color:#2196f3">แก้ไขโพสต์</h1>
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
    <form method="post" action="" enctype="multipart/form-data">
        <div class="w3-section">
            <div class="w3-margin-bottom">
                <h4>รูปภาพปัจจุบัน:</h4>
                <?php
                $current_images = explode(',', $row['pimage']);
                foreach ($current_images as $image) {
                    echo '<img src="./upload_system/uploads/' . $image . '" alt="current image">';
                }
                ?>
            </div>

            <label>เลือกรูปภาพใหม่</label>
            <p style="color: red; margin:0px; padding:0px;">*รองรับเฉพาะไฟล์ JPG, JPEG, PNG & GIF เท่านั้น</p>
            <input class="w3-input w3-border w3-round" type="file" name="pimage[]" multiple>
        </div>
        <div class="w3-section">
            <label>ชื่อโพสต์</label>
            <input class="w3-input w3-border w3-round" type="text" name="head" value="<?php echo $row['head'] ?>" maxlength="100" required>
        </div>
        <div class="w3-section">
            <label>คำอธิบายงาน</label>
            <textarea class="w3-input w3-border w3-round" name="detail" required><?php echo $row['detail']; ?></textarea>
        </div>
        <div class="w3-section">
            <label>ราคา</label>
            <input class="w3-input w3-border w3-round" type="number" name="price" value="<?php echo $row['price']; ?>" required>
        </div>
        <div class="w3-section">
            <label>ขอบเขตสถานที่</label>
            <input class="w3-input w3-border w3-round" type="text" name="location" value="<?php echo $row['location']; ?>" required>
        </div>

        <button type="submit" class="w3-btn w3-blue w3-round">บันทึกการแก้ไข</button>
    </form>
</div>

<?php include 'footer.php'; ?>
