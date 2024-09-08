<?php
$title = "รายละเอียดพนักงาน";
include 'header.php';
include './register_system/server.php';

if (isset($_GET['idPost'])) {
    $idPost = $_GET['idPost'];

    $sql = "SELECT p.*, u.nickname, u.experience FROM post AS p 
            INNER JOIN user AS u ON p.idUser = u.idUser 
            WHERE p.idPost = $idPost";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูล";
        exit;
    }
} else {
    echo "ไม่พบโพสต์ที่ต้องการ";
    exit;
}
?>

<div class="w3-container detail-container">
    <h1><?php echo $row['head']; ?></h1>
    <div class="flex-column">
        <img src="./upload_system/uploads/<?php echo explode(',', $row['pimage'])[0]; ?>" alt="รูปภาพ" class="w3-image detail-image">
    </div>
    <h4 style="margin-bottom: 0px; margin-top:10px;">รายละเอียด</h4>
    <div class="detail-content">
        <div class="w3-panel w3-border w3-round detail-panel">
            <ul>
                <li><?php echo $row['detail']; ?></li>
                <li>ราคา: <?php echo $row['price']; ?>฿</li>
                <li>ขอบเขตสถานที่: <?php echo $row['location']; ?></li>
            </ul>
        </div>
        <div class="w3-panel w3-border w3-round detail-panel profile-info">
            <img src="./pic/profile.svg" class="profile-image">
            <div class="profile-text">
                <p><strong><?php echo $row['nickname']; ?></strong></p>
                <p><?php echo $row['experience']; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
.detail-container {
    margin: auto;
    padding: 16px;
    max-width: 1200px;
    min-height: 90vh;
}

.detail-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    border-radius: 8px;
}

.detail-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.detail-panel {
    margin-bottom: 16px;
    width: 100%;
    box-sizing: border-box;
}

.profile-info {
    display: flex;
    align-items: center;
}

.profile-image {
    margin: 10px;
    width: 80px;
    height: 80px;
}

.profile-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

@media (min-width: 768px) {
    .detail-panel {
        width: 75%;
    }

    .profile-info {
        flex-direction: row;
    }
}

@media (min-width: 1024px) {
    .detail-panel {
        width: 100%;
    }
}
</style>
