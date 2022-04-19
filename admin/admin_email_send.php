<?php
    require 'admin_header.php';

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }
?>

    <div class="orders-cont">
        <div class="main-text2">Робота з клієнтами</div>
        <div class="categories">
            <?php
            global $connection;
            $news = $connection->query("SELECT * FROM `news`");
            ?>
            <div class="categories-txt"><span>Статус:</span></div>
            <a class="categories-txt" href="/admin/admin_email.php">Список адрес</a>
            <a class="categories-txt active_cat" href="/admin/admin_email_send.php">Розсилка</a>
            <div class="categories-txt"></div>
        </div>
        <div class="add-cont">
            <div class="add-btn" href=""></div>
            <p>Додати лист</p>
        </div>
        <form class="add-cont-form" method="post" action="add_news.php">
            <div class="itm">
                <div class="esc-nav"><img src="../images/esc.png" alt=""></div>
                <div class="text">Введіть тему:</div>
                <input type="text" name="title">

                <div class="text">Введіть повідомлення:</div>
                <textarea name="massage" maxlength="500"></textarea>
                <button class="more-btn" type="submit">Додати</button>
            </div>
        </form>

        <div class="categories">
            <div class="categories-txt">Кількість листів:<span><?=$news->num_rows;?></span></div>
        </div>
        <?php
        while($letter = $news->fetch_assoc()){
            ?>
            <div class="itm">
                <div class="text">Тема:<span><?=$letter['title']?></span></div>
                <div class="text">Повідомлення:<span><?=$letter['text']?></span></div>
                    <div class="done-order-cont">
                        <a class="done-order" id="send" href="/admin/send_email.php?id=<?=$letter['id']?>"></a>
                        <a class="done-order" id="delete" href="/admin/delete_email.php?id=<?=$letter['id']?>"></a>
                    </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php require 'admin_footer.php'; ?>