<?php
    session_start();
    require '../config.php';

    unset($_SESSION['admin_login']);
    unset($_SESSION['admin_password']);
    unset($_SESSION['login']);

    header("Location: ../admin.php");
    exit();
?>