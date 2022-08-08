<?php
    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }


    $newTitle = $_POST['title'];
    $newMassage = $_POST['massage'];

    function add_news()
    {
        global $connection, $newTitle, $newMassage;
        $addNews = "INSERT INTO news (id, text, title) VALUE (NULL, '$newMassage', '$newTitle')";
        if ($connection->query($addNews) === TRUE) {
            header("Location: admin_email_send.php");
            exit;
        }
    }

    if (!empty($_POST)) {
        add_news();
    }
?>