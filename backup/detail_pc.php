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

<div class="w3-container" style="margin-left: 200px; min-height:90vh;">
    <h1><?php echo $row['head']; ?></h1>
    <div class="flex-column">
        <img src="./upload_system/uploads/<?php echo explode(',', $row['pimage'])[0]; ?>" alt="รูปภาพ" class="w3-image" style="width: 856px;px; height:481.5px; object-fit: cover; border-radius:8px;">
    </div>
    <div>
        <h4>รายละเอียด</h4>
        <div class="w3-panel w3-border w3-round" style="width: 50%;">
            <ul>
                <li><?php echo $row['detail']; ?></li>
                <li>ราคา: <?php echo $row['price']; ?>฿</li>
                <li>ขอบเขตสถานที่: <?php echo $row['location']; ?></li>
            </ul>
        </div>
        <div class="w3-panel w3-border w3-round" style="width: 50%; display:flex;">
            <img src="./pic/profile.svg" style="margin: 10px;">
            <div style="display: block;">
                <p class="w3-margin"><strong><?php echo $row['nickname']; ?></strong></p>
                <p class="w3-margin"><?php echo $row['experience']; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
