<?php
    require "../config.php";
    require "../functions.php";

    session_start();

    unset($_SESSION['mail_to']);
    unset($_SESSION['error_mail']);

    function redirect(){
        if($_SERVER['REQUEST_METHOD'] == 'POST')
            header("Location: ".$_SERVER['HTTP_REFERER']."#news-cont");
        exit;
    }

    $mailTo = htmlspecialchars(trim($_POST['email']));
    $_SESSION['mail_to'] = $mailTo;

    global $connection;
    $repeat = $connection->query('SELECT email FROM `users_email`');

    $rep = [];
    while ($repeatArr = $repeat->fetch_assoc()){
        $rep[] = $repeatArr;
    }

    $mass = [];
    foreach ($rep as $key => $val) {
        foreach ($val as $k => $v){
            $mass[] = $v;
        }
    }

    if(strlen(trim($mailTo)) <= 1 || preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $mailTo) == 0){
           $_SESSION['error_mail'] = 'Email введено некоректно!';
           redirect();
        } elseif(in_array($mailTo, $mass)) {
            $_SESSION['error_mail'] = 'Дякуємо, Ви вже підписані!';
            redirect();
        } else{
           $_SESSION['error_mail'] = "";
                    $connection-> query("INSERT INTO `users_email` (`id_email` , `email`) VALUES (NULL ,'$mailTo');");
                mailer("$mailTo", "Вітання!", "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN''http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><title>Letter</title><meta name='viewport' content='width=device-width, initial-scale=1.0'/></head><body style='color: #FCFCFC; font-weight: 500; font-family: Arial, sans-serif; margin: 0px'><table style='max-width: 768px; width: 100%; margin: 0 auto; background-color: #000000; background-image: url(https://i.ibb.co/G39RLwd/back.png);'><tr style='width: 100%; height: 75px; background: #FFFF00; color: #FFD700; font-weight: 700;'><td style='float: left; padding: 15px 15px 10px 30px'><a href='http://kingsize.test/index.php'><img src='https://i.ibb.co/GTQG8hv/logo.png' width='50px' height='45px' alt=''></a></td><td style='float: right; padding: 35px 50px 0px 0px'><a href='http://kingsize.test/index.php' style='color: #1A0A03; text-decoration: none; margin-right: 30px' onmouseover='this.style.borderBottom = '2px solid #FFD700';' onmouseout='this.style.borderBottom = 'none''>Головна</a><a href='http://kingsize.test/about.php' style='color: #1A0A03; text-decoration: none;' onmouseover='this.style.borderBottom = '2px solid #FFD700';' onmouseout='this.style.borderBottom = 'none''>Про нас</a></td></tr><tr><td style='width: 80%; display: block; margin: 0 auto; color: #FFD700; font-weight: 700; text-align: center;'><p style='font-size: 26px;'>Вітаємо!</p></td></tr><tr><td style='width: 100%; text-align: center; padding: 25px 0px;'><img src='https://i.ibb.co/gWgYS0n/news-sneaker.png' width='375px' style='border-radius: 10px;' alt=''/></td></tr><tr><td style='width: 80%; display: block; margin: 0 auto; font-size: 20px;'><p style='font-size: 18px;'>Дякуємо за підписку на наші новини!</p><p style='font-size: 18px;'>Тепер Ви будете в курсі всіх наших новинок та подій!</p></td><td style='width: 80%; display: block; margin: 0 auto; font-size: 18px;'><p style='font-size: 18px;'>Про конкурси, розпродажі, оновлення та багато іншого першими дізнаєтеся саме Ви!</p></td></tr><tr><td style='width: 100%; text-align: center; padding: 25px 0px 75px 0px'><a href='http://kingsize.test/shop.php?category_id=all&limit=10'><button style='height: 55px; width: 155px; border: none;color: #000000;cursor: pointer;font-size: 18px;font-weight: 700;border-radius: 5px;background: #FFED00;padding: 2px 4px 0px 0px'>До покупок</button></a></td></tr></table></body></html>");
           redirect();
        }
?>