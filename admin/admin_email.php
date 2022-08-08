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
            $emails = $connection->query("SELECT * FROM `users_email`");
            ?>
            <div class="categories-txt"><span>Розділ:</span></div>
            <a class="categories-txt active_cat" href="/admin/admin_email.php">Список адрес</a>
            <a class="categories-txt" href="/admin/admin_email_send.php">Розсилка</a>
            <div class="categories-txt">Кількість адрес:<span><?=$emails->num_rows;?></span></div>
        </div>
        <div class="itm">
            <div class="text">E-mail клієнтів :<br>
                <?php
                    while($email = $emails->fetch_assoc()){
                        ?>
                            <br>•<span><?=$email['email']?></span><br>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

<?php require 'admin_footer.php'; ?>