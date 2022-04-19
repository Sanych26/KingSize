<?php
    require "../config.php";
    session_start();

    unset($_SESSION['mail_to']);
    unset($_SESSION['error_mail']);

    function redirect(){
        if($_SERVER['REQUEST_METHOD'] == 'POST')
            header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    }

    $mailTo = htmlspecialchars(trim($_POST['email']));
    $_SESSION['mail_to'] = $mailTo;



    if(strlen(trim($mailTo)) <= 1 || preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $mailTo) == 0){
           $_SESSION['error_mail'] = 'Email введено некоректно!';
           redirect();
       }else{
           $_SESSION['error_mail'] = "";

                global $connection;
                    $connection-> query("INSERT INTO `users_email` (`id_email` , `email`) VALUES (NULL ,'$mailTo');");

           redirect();
       }
?>