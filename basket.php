<?php require 'header.php' ?>

    <div class="registration-cont">
        <div class="content">
            <div class="registration" id="basket_cont">
                <div class="registration-left">
                    <p class="registration-name">Обрані товари</p>
                    <form class="registration-form" action="/order.php" method="post">
                            <?php
                                $prodArr = $_SESSION['cart'] ?? '';
                                if (empty($prodArr)){
                                    echo "<div id='empty-basket'><div class='itm-cont'><div  class='itm'>Корзина пуста!</div></div><div class='more-btn-cont'><a class='registration-start' id='basket-to-shop' href='/shop.php?category_id=all&limit=10'><img src='images/to_shop.png' alt=''>До покупок</a></div></div>";
                                } else{?>
                                    <div  class="itm-cont" id="title-basket">
                                        <div  class='itm'>
                                            <div class='itm-el txt'>Назва</div>
                                            <div class='itm-el txt'>Артикул</div>
                                            <div class='itm-el txt'>Розмір</div>
                                            <div class='itm-el txt'>Ціна</div>
                                        </div>
                                    </div>
                                <?php foreach ($prodArr as $id => $size) {
                                        $query = "SELECT * FROM products WHERE id='$id'";
                                        global $connection;
                                        $products = $connection->query($query);
                                        while ($product = $products->fetch_assoc()) { ?>
                                            <div  class="itm-cont">
                                                <div  class='itm'>
                                                    <div class='itm-el'><img src='<?= $product['product_img']?>' alt=''></div>
                                                    <div class='itm-el txt'><a href='product.php?product_id=<?=$product['id']?>'><?= $product['product_name']?></a></div>
                                                    <div class='itm-el txt'>art. <?= $product['product_art']?></div>
                                                    <div class='itm-el txt'><?= $size?></div>
                                                    <div class='itm-el txt'><?= $product['product_price']?>₴</div>
                                                    <div class='itm-el'><a class='del' href='send/cart_delete.php?id=<?=$product['id']?>'><img src='images/deleteFromBasket.png' alt=''></a></div>
                                                </div>
                                            </div>
                                       <?php } } ?>
                                        <div class="more-btn-cont">
                                            <a class='registration-start' id="basket-to-shop" href='/shop.php?category_id=all&limit=10'><img src="images/to_shop.png" alt="">До покупок</a>
                                            <button class="registration-start" type="submit">Оформити замовлення</button>
                                        </div>
                            <?php } ?>
                    </form>
                </div>
                <div class="registration-arrow"><img src="images/arrowReg.png" alt=""></div>
            </div>
        </div>
    </div>


<?php require 'footer.php' ?>
