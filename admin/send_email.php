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
