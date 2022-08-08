<?php
    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    $orderID = $_GET['id'];
    function delete_order()
    {
        global $connection , $status, $orderID;
        $query = "DELETE FROM `orders` WHERE id = '$orderID'";
        if ($connection->query($query) === TRUE) {
            header("Location: admin_orders.php?status=Активне");
            exit;
        }
    }
    if(empty($_GET)){
    }else{
        delete_order();
    }
?>