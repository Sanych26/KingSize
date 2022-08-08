<?php
    session_start();
    require 'config.php';
    require 'functions.php';
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>King Size</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
<div class="main-cont content">

    <header>
        <div class="content header_pc" id="head">
            <div class="menu" id="header">
                <div class="logo"><a href="/index.php"><img src="images/logo.png" alt=""></a></div>
                <div class="menu-item" id="nav-itm">
                    <div class="navicon">
                        <img src="images/navicon.png" alt="">
                    </div>
                </div>
                <div class="menu-item" id="basket-itm">
                    <?php if(isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                        if ($count >= 1) {
                            echo "<div id='basket-count-prod'><a href='basket.php'>$count</a></div>";
                        }
                    }
                    ?>
                    <a href="basket.php"><div class="basket_icon"></div></a>
                </div>
                <?php
                    global $connection;
                    $categoryId = (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) ? intval($_GET['category_id']) : 0;
                    $categories = $connection-> query("SELECT * FROM categories");
                    $activeAll = (isset($_GET['category_id']) && $_GET['category_id'] == 'all' ? 'active_cat' : '');
                    ?>
                    <div class="menu-item"><a class="item <?= $activeAll?>" href="/shop.php?category_id=all&limit=10">Все</a></div>
                <?php
                    while ($category = $categories->fetch_assoc()) {
                        $active =  $categoryId == $category['id'] ? 'active_cat' : '';
                        ?>
                        <div class="menu-item"><a class="item <?= $active?>" href="/shop.php?category_id=<?= $category['id']?>&limit=10"><?= $category['categor_name']?></a></div>
                        <?php
                    }
                ?>
            </div>
            <div class="sub-menu-cont">
                <div class="sub-menu">
                    <div class="esc-nav"><img src="images/esc.png" alt=""></div>
                    <a class="sub-item" href="/index.php">Головна</a>
                    <a class="sub-item" href="/about.php">Про нас</a>
                    <a class="sub-item" href="/payment_delivery.php">Доставка та оплата</a>
                    <a class="sub-item" href="/index.php#features">Особливості</a>
                    <a class="sub-item" href="/index.php#galeryID">Галерея</a>
                    <a class="sub-item" href="/index.php#testimonialsID">Відгуки</a>
                    <a class="sub-item" href="/index.php#news-cont">Новини</a>
                </div>
            </div>
        </div>

        <div class="content header_mob" id="head">
            <div class="menu" id="header">
                <div class="logo"><a href="/index.php"><img src="images/logo.png" alt=""></a></div>
                <div class="menu-item" id="nav-itm">
                    <div class="navicon">
                        <img src="images/navicon.png" alt="">
                    </div>
                </div>
            </div>
            <div class="sub-menu-cont">
                <div class="sub-menu">
                    <div class="esc-nav"><img src="images/esc.png" alt=""></div>
                    <?php
                        global $connection;
                        $categoryId = (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) ? intval($_GET['category_id']) : 0;
                        $categories = $connection-> query("SELECT * FROM categories");
                        $activeAll = (isset($_GET['category_id']) && $_GET['category_id'] == 'all' ? 'active_cat' : '');
                    ?>
                        <a class="sub-item <?= $activeAll?>" href="/shop.php?category_id=all&limit=10">Все</a>
                    <?php
                        while ($category = $categories->fetch_assoc()) {
                            $active =  $categoryId == $category['id'] ? 'active_cat' : '';
                            ?>
                                <a class="sub-item <?= $active?>" href="/shop.php?category_id=<?= $category['id']?>&limit=10"><?= $category['categor_name']?></a>
                    <?php } ?>
                    <a class="sub-item" href="/index.php">Головна</a>
                    <a class="sub-item" href="/about.php">Про нас</a>
                    <a class="sub-item" href="/payment_delivery.php">Доставка та оплата</a>
                    <a class="sub-item" href="/index.php#features">Особливості</a>
                    <a class="sub-item" href="/index.php#galeryID">Галерея</a>
                    <a class="sub-item" href="/index.php#testimonialsID">Відгуки</a>
                    <a class="sub-item" href="/index.php#news-cont">Новини</a>
                </div>
            </div>
        </div>
    </header>