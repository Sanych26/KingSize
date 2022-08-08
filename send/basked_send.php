<?php
    require "../config.php";

    session_start();

    unset($_SESSION['error_size']);
    $size = $_POST['size']??'';
    $prodId = $_POST['prodToBasket'];

    function redirect($link){
        header("Location: /$link");
        exit;
    }

    if(trim($size) == ""){
        $_SESSION['error_size'] = "Оберіть потрібний розмір!";
        redirect("product.php?product_id=$prodId");
    } else{
        if (!isset($_SESSION['cart'])) {//если сесия корзины не существует
            $prodArr[$prodId] = $_POST['size'];//в масив заносим количество розмір товара
        } else {//если в сесии корзины уже есть товары
            $prodArr = $_SESSION['cart'];//заносим в масив старую сесию
            if (!array_key_exists($prodId, $prodArr)) {//проверяем есть ли в корзине уже такой товар
                $prodArr[$prodId] = $_POST['size']; //в масив заносим количество розмір товара
            }
        }
        $count = count($prodArr);//считаем товары в корзине
        $_SESSION['cart'] = $prodArr;//записывае в сесию наш масив
        $_SESSION['prodCount'] = $count;
        $_SESSION['error_size'] = "";

        redirect("basket.php");
    }
?>