<?php
    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require "../config.php";
    session_start();

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    function redirect(){
        header("Location: admin_email.php");
        exit();
    }

    global $connection;
    $letterId = $_GET['id'];
    $letters = $connection->query("SELECT * FROM `news` WHERE id = '$letterId'");
    $letter = $letters->fetch_assoc();
    $users = $connection->query("SELECT * FROM `users_email`");

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'king.size.shoesshop@gmail.com';        //SMTP username
        $mail->Password   = 'kingsize0221';                         //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('king.size.shoesshop@gmail.com', 'King Size');



        //        //Attachments
        //        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $subject = $letter['title'];
        $body = $letter['text'];

//        $subject = "Вітання!";
//        $body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN''http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><title>Letter</title><meta name='viewport' content='width=device-width, initial-scale=1.0'/></head><body style='color: #FCFCFC; font-weight: 500; font-family: Arial, sans-serif; margin: 0px'><table style='max-width: 768px; width: 100%; margin: 0 auto; background-color: #000000; background-image: url(https://i.ibb.co/G39RLwd/back.png);'><tr style='width: 100%; height: 75px; background: #FFFF00; color: #FFD700; font-weight: 700;'><td style='float: left; padding: 15px 15px 10px 30px'><a href='http://kingsize.test/index.php'><img src='https://i.ibb.co/GTQG8hv/logo.png' width='50px' height='45px' alt=''></a></td><td style='float: right; padding: 35px 50px 0px 0px'><a href='http://kingsize.test/index.php' style='color: #1A0A03; text-decoration: none; margin-right: 30px' onmouseover='this.style.borderBottom = '2px solid #FFD700';' onmouseout='this.style.borderBottom = 'none''>Головна</a><a href='http://kingsize.test/about.php' style='color: #1A0A03; text-decoration: none;' onmouseover='this.style.borderBottom = '2px solid #FFD700';' onmouseout='this.style.borderBottom = 'none''>Про нас</a></td></tr><tr><td style='width: 80%; display: block; margin: 0 auto; color: #FFD700; font-weight: 700; text-align: center;'><p style='font-size: 26px;'>Вітаємо!</p></td></tr><tr><td style='width: 100%; text-align: center; padding: 25px 0px;'><img src='https://i.ibb.co/gWgYS0n/news-sneaker.png' width='375px' style='border-radius: 10px;' alt=''/></td></tr><tr><td style='width: 80%; display: block; margin: 0 auto; font-size: 20px;'><p style='font-size: 18px;'>Дякуємо за підписку на наші новини!</p><p style='font-size: 18px;'>Тепер Ви будете в курсі всіх наших новинок та подій!</p></td><td style='width: 80%; display: block; margin: 0 auto; font-size: 18px;'><p style='font-size: 18px;'>Про конкурси, розпродажі, оновлення та багато іншого першими дізнаєтеся саме Ви!</p></td></tr><tr><td style='width: 100%; text-align: center; padding: 25px 0px 75px 0px'><a href='http://kingsize.test/shop.php?category_id=all&limit=10'><button style='height: 55px; width: 155px; border: none;color: #000000;cursor: pointer;font-size: 18px;font-weight: 700;border-radius: 5px;background: #FFED00;padding: 2px 4px 0px 0px'>До покупок</button></a></td></tr></table></body></html>";


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//        $mail->addAddress('oleksandr-shostakivsky@ukr.net', '');     //Add a recipient
//        $mail->send();

            while ($user = $users->fetch_assoc()){
                $mail->addAddress($user['email']);     //Add a recipient
                $mail->send();
            }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
