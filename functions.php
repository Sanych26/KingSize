<?php

/**
 * Output array
 **/
//    function print_arr($array)
//    {
//        echo "<pre>" . print_r($array , true) . "</pre>";
//    }

///**
// * Redirect
// **/
//function redir($link)
//{
//    header("Location: $link");
//    exit();
//}

/**
 * Add gallery
 **/
    function add_files($gallery, $dir = '/images/testimonials/')
    {
        $uploadfileGallery = $_SERVER['DOCUMENT_ROOT'] . $dir . basename($gallery['name']);
        if (!is_uploaded_file($gallery['tmp_name'])) {
            echo "Загрузка файла на сервер не удалась";
            die(); //or throw exception...
        }
        //Проверка что это картинка
        if (!getimagesize($gallery['tmp_name'])) {
            echo "Это не картинка...";
            die(); //or throw exception...
        }
        if (move_uploaded_file($gallery['tmp_name'], $uploadfileGallery)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
        return $dir . $gallery['name'];
    }

/**
 * Mailer
 **/
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function mailer($addressTo, $subject, $body)
    {
        $mail = new PHPMailer(true);


            //Server settings
            $mail->CharSet = "utf-8";
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'king.size.shoesshop@gmail.com';        //SMTP username
            $mail->Password   = 'kingsize0221';                         //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('king.size.shoesshop@gmail.com', 'King Size');
            $mail->addAddress($addressTo);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
    }
?>