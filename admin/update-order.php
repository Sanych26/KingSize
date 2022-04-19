<?php
    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    $status =  $_GET['status'];
    $orderID = $_GET['id'];
    function change_order()
    {
        global $connection , $status, $orderID;
        $query = "UPDATE orders SET status = '$status' WHERE id = '$orderID'";
        if ($connection->query($query) === TRUE) {
            header("Location: admin_orders.php?status=Активне");
            exit;
        }
    }
    if(empty($_GET)){
    }else{
        change_order();
    }
?>