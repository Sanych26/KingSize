<?php
    require "header.php";

    global $connection;
?>

    <div class="registration-cont" id="order-done-cont">
        <div class="content">
            <div class="registration">
                <div class="registration-left">
                    <p class="registration-name">Дякуємо за довіру до нас!</p>
                    <p>Ваше замовлення сформовано!</p>
                    <p>В найближчий час ми зв'яжемося з Вами для підтвердження замовлення.</p>
                    <p>Якщо виникнуть питання — в будь-який час Ви можете звернутися <a href="mailto:king.size.shoesshop@gmail.com">king.size.shoesshop@gmail.com</a>, ми завжди на зв'язку.</p>
                    <p>Дуже чекаємо на Ваш відгук.</p>
                    <div id="basket_cont">
                        <div class="more-btn-cont">
                            <a class='registration-start' id="basket-to-shop" href='/shop.php?category_id=all&limit=10'><img src="images/to_shop.png" alt="">До покупок</a>
                        </div>
                    </div>
                </div>
                <div class="registration-arrow"><img src="images/order_done.png" alt=""></div>
            </div>
        </div>
    </div>

<?php require "footer.php"?>