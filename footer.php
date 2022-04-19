
<div class="registration-back"></div>
</div>

<footer>
    <div class="footer-back"><div class="background-mask"></div></div>
    <div id="news-cont">
            <div class="news-form-cont">
                <div class="news-form">
                    <div class="txt1">Підпишись на наші Новини!</div>
                    <div class="txt2">Повідомимо Вас про знижки та бонуси.<br />Ми прагнемо бути ближче до Вас.</div>
                    <div class="news-mail">
                        <form name="mail_form" action="send/mail_send.php" method="post">
                            <input class="form-label" type="text" name="email" value="<?=$_SESSION['mail_to']??''?>" placeholder="Введіть Ваш E-mail">
                            <button class="apply-btn" type="submit">Відправити</button>
                            <div class="error-form"><?=$_SESSION['error_mail']??''?></div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <div class="social-cont">
        <div class="social">
            <a href="https://www.instagram.com/king.size_shoes/"><img src="images/inst.png" alt=""></a>
            <a href="https://t.me/uncle_sanych"><img src="images/telega.png" alt=""></a>
            <a href="viber://chat?number=+380977000838"><img src="images/viber.png" alt=""></a>
        </div>
        <div class="menu-foot">
            <ul class="item-foot">
                <li><a class="menu-item-foot" href="">Допомога:</a></li>
                <li>
                    <div class="menu-item-foot2"><a href="/privacy_policy.php">Політика конфіденційності</a></div>
                </li>
            </ul>
            <ul class="item-foot">
                <li><a class="menu-item-foot">Зв'язатися з нами:</a></li>
                <li>
                    <div class="menu-item-foot2"><a href="mailto:king.size.shoesshop@gmail.com">king.size.shoesshop@gmail.com</a></div>
                </li>
            </ul>
        </div>
    </div>
</footer>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
<!--[if (lt IE 9)]><script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.helper.ie8.js"></script><![endif]-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script type="text/javascript" src="java_script/jquery.maskedinput.js"></script>
<script src="java_script/main.js"></script>

</body>

</html>
