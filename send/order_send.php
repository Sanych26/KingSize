<?php
    require "../config.php";
    require "../functions.php";

    session_start();

    unset($_SESSION['payment']);
    unset($_SESSION['delivery']);
    unset($_SESSION['phone']);
    unset($_SESSION['fio']);
    unset($_SESSION['address']);

    unset($_SESSION['error_payment']);
    unset($_SESSION['error_delivery']);
    unset($_SESSION['error_phone']);
    unset($_SESSION['error_name']);
    unset($_SESSION['error_address']);

    $cart = $_SESSION['cart'];

    foreach ($cart as $id => $size) {
        $arrId[] = $id;
        $arrSize[] = $size;
    }

    $productId = implode(", ",$arrId);
    $productSize = implode(", ",$arrSize);

    $payment = $_POST['payment'];
    $delivery = $_POST['delivery'];
    $phone = htmlspecialchars(trim($_POST['phone']));
    $name = htmlspecialchars(trim($_POST['fio']));
    $addressTo = htmlspecialchars(trim($_POST['addressTo']));

    $_SESSION['payment'] = $payment;
    $_SESSION['delivery'] = $delivery;
    $_SESSION['phone'] = $phone;
    $_SESSION['fio'] = $name;
    $_SESSION['address'] = $addressTo;

    function redirect(){
        header("Location: ../order.php");
            exit;
    }



    if(trim($payment) == ""){
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
        mail("sshostakivsky@gmail.com", "Замовлення з сайту kingsize", "Переглянути: http://kingsize.pp.ua/admin.php");

        $_SESSION['error_payment'] = "";
        $_SESSION['error_delivery'] = "";
        $_SESSION['error_phone'] = "";
        $_SESSION['error_name'] = "";
        $_SESSION['error_address'] = "";
        unset($_SESSION['cart']);

        global $connection;
            $connection-> query("INSERT INTO `orders` (`id` , `order_size` , `order_payment` , `order_delivery` , `order_phone` , `order_fio` , `order_address` , `status` , `product_id`, `date`) VALUES (NULL, '$productSize' , '$payment' , '$delivery' , '$phone' , '$name' , '$addressTo' , 'Активне' , '$productId' , CURRENT_TIMESTAMP());");

        header('Location: ../order_done.php');
        exit;
    }

?>