<?php
    session_start();

    $id = $_GET['id'];
    $cart = $_SESSION['cart'];
    unset($cart[$id]);

    $_SESSION['cart'] = $cart;

    function redirect(){
        header("Location: /basket.php");
        exit;
    }

    redirect();
?>
