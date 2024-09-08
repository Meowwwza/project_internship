<?php
$title = "โพสต์ของฉัน";
include 'header.php';
include './register_system/server.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินแล้วหรือไม่
if (!isset($_SESSION['idUser'])) {
    header('Location: login.php');
    exit;
}

// รับ userId จาก session
$userId = $_SESSION['idUser'];

?>

<header class="w3-container w3-center">
    <h1 style="color:#2196F3;">งานของฉัน</h1>
</header>

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

<style>
    .w3-quarter {
        padding: 16px;
    }

    .custom-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .custom-content {
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .custom-card {
        height: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        text-decoration: none;
        /* เพิ่มเพื่อทำให้การ์ดไม่มีขีดเส้นใต้ */
    }

    .custom-card h4 {
        margin: 0 0 8px 0;
    }

    .custom-content h4 {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
        /* หรือกำหนดความกว้างที่ต้องการ */
    }


    .custom-card p {
        margin: 0;
    }

    .price-container {
        text-align: right;
    }

    .edit-delete-container {
        display: flex;
        justify-content: space-between;
        margin-top: 16px;
    }

    .edit-delete-container a {
        flex: 1;
        text-align: center;
        margin: 0 5px;
    }
</style>

<div class="w3-row-padding w3-padding-16" style="margin-left:auto; margin-right:auto; max-width:1600px; min-height:80vh;">
    <?php
    $sql = "SELECT * FROM post WHERE idUser = $userId ORDER BY idPost DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // แสดงข้อมูลแต่ละแถว
        while ($row = $result->fetch_assoc()) {
            // แยกชื่อไฟล์รูปภาพ
            $imageFiles = explode(',', $row['pimage']);
            // ใช้รูปภาพแรก
            $firstImage = $imageFiles[0];
    ?>
            <div class="w3-quarter w3-margin-bottom">
                <a href="detail_pc.php?idPost=<?php echo $row['idPost']; ?>" style="text-decoration: none;">
                    <div class="w3-card custom-card">
                        <img src="./upload_system/uploads/<?php echo $firstImage; ?>" alt="pc" class="custom-img">
                        <div class="custom-content">
                            <h4><?php echo $row['head']; ?></h4>
                            <div class="price-container">
                                <p style="color: gray;"><?php echo $row['price']; ?>฿</p>
                            </div>
                            <div class="edit-delete-container">
                                <a href="edit_post.php?idPost=<?php echo $row['idPost']; ?>" class="w3-btn w3-blue w3-round" style="margin-right: 10px; padding:4px; text-align:center">แก้ไข</a>
                                <a href="delete_post.php?idPost=<?php echo $row['idPost']; ?>" class="w3-btn w3-red w3-round" style="margin-left: 10px; padding:4px; text-align:center;" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบโพสต์นี้?');">ลบ</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    <?php
        }
    } else {
        echo "<p class='w3-center'>ไม่มีโพสต์</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>