<?php
include './register_system/server.php';

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT p.*, u.nickname, c.category FROM post AS p 
            INNER JOIN user AS u ON p.idUser = u.idUser 
            INNER JOIN category AS c ON p.idCategory = c.idCategory 
            WHERE p.head LIKE '%$search%' OR p.price LIKE '%$search%' OR u.nickname LIKE '%$search%'
            ORDER BY p.idPost DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imageFiles = explode(',', $row['pimage']);
            $firstImage = $imageFiles[0];
            echo '<div class="w3-quarter w3-margin-bottom">';
            echo '<a href="detail_pc.php?idPost=' . $row['idPost'] . '" style="text-decoration: none;">';
            echo '<div class="w3-card custom-card">';
            echo '<img src="./upload_system/uploads/' . $firstImage . '" alt="pc" class="custom-img">';
            echo '<div class="custom-content">';
            echo '<h4>' . $row['head'] . '</h4>';
            echo '<div class="price-container">';
            echo '<p style="color: gray;">' . $row['price'] . '฿</p>';
            echo '</div></div></div></a></div>';
        }
    } else {
        echo '<p class="w3-center">ไม่มีข้อมูล</p>';
    }
}
?>
