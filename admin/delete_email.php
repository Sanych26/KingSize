<?php
    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    $letterID = $_GET['id'];
    function delete_letter()
    {
        global $connection, $letterID;
        $query = "DELETE FROM `news` WHERE id = '$letterID'";
        if ($connection->query($query) === TRUE) {
            header("Location: admin_email_send.php");
            exit;
        }
    }
    if(!empty($_GET)){
        delete_letter();
    }

?>