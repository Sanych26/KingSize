<?php
require 'admin_header.php';

if (!$_SESSION['login']){
    header("Location: ../admin.php");
    exit;
}
?>

    <div class="orders-cont" id="admin-testimonials">
        <div class="main-text2">Робота з відгуками</div>
            <?php
                global $connection;
                $testimonials = $connection->query("SELECT * FROM `testimonials` ORDER BY `id` DESC");
            ?>
        <div class="add-cont">
            <div class="add-btn"></div>
            <p>Додати відгук</p>
        </div>

        <form class="add-cont-form" method="post" action="add_testmonial.php" enctype="multipart/form-data">
            <div class="itm">
                <div class="esc-nav"><img src="../images/esc.png" alt=""></div>
                <div class="error-form"><?=$_SESSION['product_err'] ?? ''?></div>
                <div class="text">Введіть ім'я покупця:</div>
                    <input type="text" name="name">
                <div class="text">Введіть заголовок:</div>
                    <textarea name="title" maxlength="100"></textarea>
                <div class="text">Введіть основний текст:</div>
                    <textarea name="text" maxlength="500"></textarea>
                <div class="text">Додайте аватар:</div>
                    <input type="file" name="ava">

                <button class="more-btn" type="submit">Додати</button>
            </div>
        </form>


        <div class="categories">
            <div class="categories-txt">Кількість відгуків:<span><?=$testimonials->num_rows;?></span></div>
        </div>
        <?php
        while($testimonial = $testimonials->fetch_assoc()){
            ?>
            <div class="itm">
                <div class="text">Покупець:<span><?=$testimonial['user_name']?></span></div>
                <div class="text">Заголовок:<span><?=$testimonial['user_text1']?></span></div>
                <div class="text">Основний текст:<span><?=$testimonial['user_text2']?></span></div>
                <div class="text">Аватар покупця:
                    <img class="admin-product-img" src="../<?=$testimonial['user_photo']?>">
                </div>
                <div class="done-order-cont">
                    <a class="done-order" id="delete" href="/admin/delete_testimonials.php?id=<?=$testimonial['id']?>"></a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php require 'admin_footer.php'; ?>