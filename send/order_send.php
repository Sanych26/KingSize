<?php
    require "../config.php";

    session_start();

    unset($_SESSION['size']);
    unset($_SESSION['payment']);
    unset($_SESSION['delivery']);
    unset($_SESSION['phone']);
    unset($_SESSION['fio']);
    unset($_SESSION['address']);

    unset($_SESSION['error_size']);
    unset($_SESSION['error_payment']);
    unset($_SESSION['error_delivery']);
    unset($_SESSION['error_phone']);
    unset($_SESSION['error_name']);
    unset($_SESSION['error_address']);


    $productId = $_SESSION['prodId'];
    $size = $_POST['size'];
    $payment = $_POST['payment'];
    $delivery = $_POST['delivery'];
    $phone = htmlspecialchars(trim($_POST['phone']));
    $name = htmlspecialchars(trim($_POST['fio']));
    $addressTo = htmlspecialchars(trim($_POST['addressTo']));

    $_SESSION['size'] = $size;
    $_SESSION['payment'] = $payment;
    $_SESSION['delivery'] = $delivery;
    $_SESSION['phone'] = $phone;
    $_SESSION['fio'] = $name;
    $_SESSION['address'] = $addressTo;


    function redirect(){
        global $productId;
        header("Location: ../order.php?product_id=$productId");
            exit;
        }


    if(trim($size) == ""){
        $_SESSION['error_size'] = "Оберіть потрібний розмір!";
        redirect();
    } else if(trim($payment) == ""){
        $_SESSION['error_payment'] = "Оберіть спосіб оплати!";
        redirect();
    } else if(trim($delivery) == ""){
        $_SESSION['error_delivery'] = "Оберіть спосіб доставки!";
        redirect();
    } else if (strlen(trim($phone)) <= 16){
        $_SESSION['error_phone'] = "Введіть номер телефону і ми зв'яжемося з Вами!";
        redirect();
    } else if (strlen(trim($name)) <= 1 || preg_match("/^[а-я А-ЯёЁЇїІіЄєҐґ\.]+$/u",$name) == false){
        $_SESSION['error_name'] = "Введіть коректне ім'я!";
        redirect();
    } else if(strlen(trim($addressTo)) <= 10 || preg_match("/^[а-яА-ЯёЁЇїІіЄєҐґ0-9\,\.\-\ ]+$/u",$addressTo) == false){
        $_SESSION['error_address'] = "Введіть коректну адресу!";
        redirect();
    } else{
        $_SESSION['error_size'] = "";
        $_SESSION['error_payment'] = "";
        $_SESSION['error_delivery'] = "";
        $_SESSION['error_phone'] = "";
        $_SESSION['error_name'] = "";
        $_SESSION['error_address'] = "";
            global $connection;
            $connection-> query("INSERT INTO `orders` (`id` , `order_size` , `order_payment` , `order_delivery` , `order_phone` , `order_fio` , `order_address` , `status` , `product_id`, `date`) VALUES (NULL, '$size' , '$payment' , '$delivery' , '$phone' , '$name' , '$addressTo' , 'Активне' , '$productId' , CURRENT_TIMESTAMP());");

        header('Location: ../index.php');
        exit;
    }

?>