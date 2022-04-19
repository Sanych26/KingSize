<?php
    require "../config.php";
    require "../functions.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    unset($_SESSION['product_err']);


    function redirect(){
        header("Location: admin_testimonials.php");
        exit;
    }


    global $connection;

    $name = $_POST['name'] ?? '';
    $title = $_POST['title'] ?? '';
    $text = $_POST['text'] ?? '';
    $ava = $_FILES['ava'];


    function add_product()
    {
        global $connection, $name, $title, $text, $avaUrl;
        $addtestimon = "INSERT IGNORE INTO testimonials (id, user_name, user_photo, user_text1, user_text2) VALUE (NULL, '$name', '$avaUrl', '$title', '$text')";
        if ($connection->query($addtestimon) === TRUE) ;
    }

    if (trim($name) == '' || trim($title) == '' || trim($text) == ''){
        $_SESSION['product_err'] = 'Введіть всі дані!';
        redirect();
    }else {
        $_SESSION['product_err'] = '';
        if (!empty($_POST)) {
            $avaUrl = add_files($ava);
            add_product();
            redirect();
        }
    }

?>