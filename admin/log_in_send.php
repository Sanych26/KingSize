<?php
    session_start();
    require '../config.php';

    unset($_SESSION['admin_login']);
    unset($_SESSION['admin_password']);

    unset($_SESSION['error_login']);
    unset($_SESSION['error_pass']);

    function redirect(){
        header("Location: ../admin.php");
        exit;
    }

    if (empty($_POST)){
        return;
    }
    $login = htmlspecialchars(trim($_POST['admin_login']));
    $pass = htmlspecialchars(trim($_POST['admin_password']));

    $_SESSION['admin_login'] = $login;
    $_SESSION['admin_password'] = $pass;

    global $connection;
    $adminTable = $connection->query("SELECT * FROM `admin`;");
    $admin = $adminTable->fetch_assoc();

    $adminPass = $admin['password'];

//    $insert = $connection->query("INSERT INTO `admin`(id, login, password) VALUES (NULL, 'admin', '$passHash')");

        if ($login == '' || $login !== $admin['login']) {
            $_SESSION['error_login'] = "Некоректно введений логін!";
            redirect();
        }elseif ($pass == '' || password_verify($pass, $adminPass) == false) {
            $_SESSION['error_pass'] = "Некоректно введений пароль!";
            redirect();
        }else{
            $_SESSION['error_login'] = '';
            $_SESSION['error_pass'] = '';
            $_SESSION['login'] = true;
            header("Location: admin_orders.php?status=Активне");
            exit;
        }

?>