<?php
    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    $tesID = $_GET['id'];
    function delete_testimonial()
    {
        global $connection , $tesID;
        $query = "DELETE FROM `testimonials` WHERE id = '$tesID'";

        if ($connection->query($query) === TRUE){
            header("Location: admin_testimonials.php");
            exit;
        }
    }
    if(empty($_GET)){
    }else{
        delete_testimonial();
    }
?>