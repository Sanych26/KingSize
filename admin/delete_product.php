<?php
    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    function redirect()
    {
        header("Location: admin_products.php");
        exit;
    }

    $productID = $_GET['id'];

    function delete_product()
    {
        global $connection , $productID;
        $query1 = "DELETE FROM `sizeProduct` WHERE product_id = '$productID'";
        $query2 = "DELETE FROM `categoryOfProduct` WHERE product_id = '$productID'";
        $query3 = "DELETE FROM `galleryProduct` WHERE product_id = '$productID'";
        $query4 = "DELETE FROM `products` WHERE id = '$productID'";

        if ($connection->query($query1) === TRUE){
            if ($connection->query($query2) === TRUE){
                if ($connection->query($query3) === TRUE){
                    if ($connection->query($query4) === TRUE) {
                        redirect();
                    }
                }
            }
        }
    }
    if(empty($_GET)){
    }else{
        delete_product();
    }
?>