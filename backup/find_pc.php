<?php $title = "ค้นหาพนักงาน";
include 'header.php'; ?>

<style>
    .w3-quarter {
        width: 24%;
        padding: 16px;
    }

    .custom-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .custom-content {
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .custom-content h4 {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
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

    .custom-card p {
        margin: 0;
    }

    .price-container {
        margin-top: auto;
        text-align: right;
    }

    .search-form {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    #searchInput {
        width: 20%;
        margin-bottom: 20px;
    }

    #searchResults {
        display: flex;
        flex-wrap: wrap;
        justify-content: center; /* จัดให้อยู่ตรงกลาง */
        width: 100%;
    }

    /* Responsive adjustments
    @media (max-width: 1200px) {
        .w3-quarter {
            width: 48%;
        }
    }

    @media (max-width: 768px) {
        .w3-quarter {
            width: 100%;
        }

        .search-form {
            width: 90%;
        }

        #searchInput {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .search-form {
            width: 100%;
        }

        #searchInput {
            width: 100%;
        }
    } */
</style>

<div class="w3-container w3-padding w3-center">
    <h1 class="w3-center" style="color:#2196F3; ">ค้นหาพนักงาน PC</h1><br><br>
    <h3 class="w3-center">โปรโมชั่น</h3>
    <img src="./pic/promo.jpg" alt="โปรโมชั่น" style="width: 40%;" >
</div>

<div class="w3-container w3-center search-container" style="min-height:52vh;">
    <form action="#" class="search-form">
        <input id="searchInput" class="w3-input w3-border w3-round" type="search" placeholder="ค้นหา...">
    </form><br>
    <a class="w3-btn w3-blue w3-border w3-border-blue w3-round" href="./find_all_pc.php">ค้นหาทั้งหมด</a>
    <div id="searchResults" class="w3-row-padding w3-padding-16"></div>
</div>
<?php include 'chat.php'; ?>
<?php include 'footer.php'; ?>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    var searchValue = this.value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'search.php?search=' + encodeURIComponent(searchValue), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('searchResults').innerHTML = xhr.responseText;
        } else {
            console.error('Error: ' + xhr.status);
        }
    };
    xhr.send();
});
</script>
