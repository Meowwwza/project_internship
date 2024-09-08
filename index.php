<?php $title = "หน้าแรก";
include 'header.php'; ?>

<div class="w3-center" style="margin-bottom:0px; color:#2196F3">
    <h1>โปรดเลือกหมวดหมู่พนักงาน</h1>
</div>
<div class="w3-row" style="min-height: 88vh; justify-content:center; align-items:center; display:flex; flex-wrap: wrap; margin-left:auto; margin-right:auto;">
    <div class="w3-third w3-center">
        <a href="./find_pc.php" style="text-decoration: none;"><img src="./pic/pc_index.png" class="w3-circle" alt="pc" style="width: 300px; height: 300px;">
            <h2>PC</h2>
        </a>
    </div>
    <div class="w3-third w3-center"> 
        <a href="./coming_soon.php" style="text-decoration: none;"><img src="./pic/seller.png" class="w3-circle" alt="sales" style="width: 300px; height:300px;">
            <h2>seller</h2>
        </a>
    </div>
    <div class="w3-third w3-center">
        <a href="./coming_soon.php" style="text-decoration: none;"><img src="./pic/tiktok_f.png" class="w3-circle" alt="tiktok" style="width: 300px; height: 300px;">
            <h2>tiktok</h2>
        </a>
    </div>
</div>




<?php include 'chat.php'; ?>
<?php include 'footer.php'; ?>