<?php
$title = "จัดการโพสต์พนักงาน";
include 'header.php';
include './register_system/server.php';
?>

<style>
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
    }

    .custom-card h4 {
        margin: 0 0 8px 0;
    }

    .custom-content h4 {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
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

    .w3-quarter {
        padding: 16px;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .w3-quarter {
            width: 50%;
        }
    }

    @media (max-width: 480px) {
        .w3-quarter {
            width: 100%;
        }
    }

    .header-center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>

<header class="w3-container w3-center header-center">
    <h1 style="color:#2196F3;">จัดการโพสต์พนักงาน PC</h1>
    <form method="GET" action="">
        <input class="w3-input w3-border w3-round" type="search" name="search" placeholder="ค้นหา..." style="max-width: 400px; margin: auto;">
        <br>
        <select class="w3-select w3-border w3-round" name="idCategory" style="max-width: 400px; margin: auto;">
            <option value="" disabled selected>เลือกหมวดหมู่</option>
            <?php
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['idCategory'] . '">' . $row['category'] . '</option>';
            }
            ?>
        </select>
        <br><br>
        <button type="submit" class="w3-btn w3-blue w3-round">ค้นหา</button>
    </form><br><br>
</header>

<div class="center-container">
    <div class="w3-row-padding w3-padding-16" style="max-width: 1600px;">
        <?php
        $whereClause = '';
        $conditions = [];

        if (isset($_GET['idCategory']) && $_GET['idCategory'] != '') {
            $idCategory = $_GET['idCategory'];
            $conditions[] = "p.idCategory = " . intval($idCategory);
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $search = $conn->real_escape_string($_GET['search']);
            $conditions[] = "(p.head LIKE '%$search%' OR p.price LIKE '%$search%' OR u.nickname LIKE '%$search%')";
        }

        if (!empty($conditions)) {
            $whereClause = "WHERE " . implode(' AND ', $conditions);
        }

        $sql = "SELECT p.*, u.nickname, c.category FROM post AS p 
                INNER JOIN user AS u ON p.idUser = u.idUser 
                INNER JOIN category AS c ON p.idCategory = c.idCategory 
                $whereClause 
                ORDER BY p.idPost DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageFiles = explode(',', $row['pimage']);
                $firstImage = $imageFiles[0];
        ?>
                <div id="findall" class="w3-quarter w3-margin-bottom">
                    <a href="detail_pc.php?idPost=<?php echo $row['idPost']; ?>" style="text-decoration: none;">
                        <div class="w3-card custom-card">
                            <img src="./upload_system/uploads/<?php echo $firstImage; ?>" alt="pc" class="custom-img">
                            <div class="custom-content">
                                <h4><?php echo $row['head']; ?></h4>
                                <div class="price-container">
                                    <p style="color: gray;"><?php echo $row['price']; ?>฿</p>
                                </div>
                                <div class="edit-delete-container">
                                    <a href="edit_post.php?idPost=<?php echo $row['idPost']; ?>" class="w3-btn w3-blue w3-round" style="padding:4px;">แก้ไข</a>
                                    <a href="delete_post.php?idPost=<?php echo $row['idPost']; ?>" class="w3-btn w3-red w3-round" style="padding:4px;" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบโพสต์นี้?');">ลบ</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        } else {
            echo "<p class='w3-center'>ไม่มีข้อมูล</p>";
        }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
