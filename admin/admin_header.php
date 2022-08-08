<?php
    session_start();
    require '../config.php';
    require '../functions.php';
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>King Size</title>
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
<div class="main-cont">
    <div class="main">
        <div class="content" id="administration">
            <header>
                <div id="head">
                    <div class="menu" id="header">
                        <div class="logo"><a href="/index.php"><img src="../images/logo.png" alt=""></a></div>
                        <div class="menu-item" id="nav-itm">
                            <div class="navicon">
                                <img src="../images/navicon.png" alt="">
                            </div>
                        </div>
                        <?php
                            $activeAll = (isset($_GET['category_id']) && $_GET['category_id'] == 'all' ? 'active_cat' : '');
                        ?>
                        <div class="menu-item"><a class="item <?= $activeAll?>" href="/admin/admin_orders.php?status=Активне">Замовлення</a></div>
                        <div class="menu-item"><a class="item <?= $activeAll?>" href="/admin/admin_products.php">Товари</a></div>
                        <div class="menu-item"><a class="item <?= $activeAll?>" href="/admin/admin_email.php">Листи</a></div>
                        <div class="menu-item"><a class="item <?= $activeAll?>" href="/admin/admin_testimonials.php">Відгуки</a></div>
                        <div class="menu-item" id="exit"><a class="item" href="/admin/exit.php">Вийти</a></div>
                    </div>
                    <div class="sub-menu-cont">
                        <div class="sub-menu">
                            <div class="esc-nav"><img src="../images/esc.png" alt=""></div>
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