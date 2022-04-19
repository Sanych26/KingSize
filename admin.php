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
    <div class="main-cont">
        <div class="main">
            <div class="content">
                <div class="login-cont">
                    <form class="registration-form" method="post" action="admin/log_in_send.php">
                        <p class="registration-name">Введіть дані для входу</p>
                        <div class="registration-input-field">
                            <img src="images/login.png" alt="">
                            <input class="registration-label" type="text" name="admin_login" value="<?=$_SESSION['admin_login']??''?>" placeholder="Введіть логін">
                            <div class="error-form"><?=$_SESSION['error_login']??''?></div>
                        </div>
                        <div class="registration-input-field">
                            <img src="images/password.png" alt="">
                            <input class="registration-label" type="password" name="admin_password" value="<?=$_SESSION['admin_password']??''?>" placeholder="Введіть пароль">
                            <div class="error-form"><?=$_SESSION['error_pass']??''?></div>
                        </div>
                            <button class="registration-start" type="submit">Увійти</button>
                    </form>
                </div>

<?php require 'admin/admin_footer.php'; ?>
