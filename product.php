<?php require "header.php"?>
<?php
    global $connection;
    $productId = (isset($_GET['product_id']) && intval($_GET['product_id']) > 0) ? intval($_GET['product_id']) : 0;
    $query = "SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id)";
        if ($productId > 0){
            $query .= "WHERE categoryOfProduct.product_id = '$productId'";
        }
    $products = $connection-> query($query);
    $galleryProduct = $connection-> query("SELECT * FROM `galleryProduct` WHERE product_id = '$productId'");
    $sizeProduct = $connection-> query("SELECT * FROM `sizeProduct` WHERE product_id = '$productId'");
?>
<div class="main">
    <div class="content">
        <div class="models-cont" id="galery-cont">
            <?php
                while($product = $products->fetch_assoc()) {
                            ?>
                                <div class="txt1"><?= $product['product_name']; ?></div>
                                <div class="txt2" id="galery-price">Артикул: <span> <?= $product['product_art']; ?></span></div>
                                <div class="txt2" id="galery-price">Ціна: <span> <?= $product['product_price']; ?> ₴</span></div>
                                <div id="pictures">
                                    <?php
                                        while ($gallery = $galleryProduct->fetch_assoc()){
                                    ?>
                                    <div><img src="<?= $gallery['product_photo']; ?>" alt=""></div>
                                    <?php  } ?>
                                </div>
                                <div class="models-text-cont">
                                    <div class="txt2 models-txt" id="galery-size">Опис:<span> <?= $product['description']; ?></span></div>
                                </div>

                                <div class="models-text-cont">
                                    <div class="buy-btn-cont">
                                        <form method="post" action="send/basked_send.php">
                                            <div class="models-text-cont">
                                                <div class="txt2 models-txt" id="galery-size">Розміри в наявності:<br>
                                                    <div id="radio-cont">
                                                        <?php
                                                            while ($size = $sizeProduct->fetch_assoc()){
                                                                if ($size['size'] != NULL){?>
                                                                    <div>
                                                                        <input type="radio" id="<?= $size['size']?>" name="size" value="<?= $size['size']?>">
                                                                        <label for="<?= $size['size']?>"><?= $size['size']?></label><br>
                                                                    </div>
                                                                <?php }else {
                                                                    $_SESSION['emptySize'] = 1;
                                                                ?>
                                                                    <span class="txt2">Немає в наявності</span>
                                                        <?php } }?>
                                                    </div>
                                                    <div class="error-form"><?=$_SESSION['error_size']??''?></div>
                                                </div>
                                            </div>
                                            <?php if($_SESSION['emptySize']??'' != 1){?>
                                                <input type="hidden" name="prodToBasket" value="<?=$product['id']?>">
                                                <button type="submit" class="buy-btn"><p>Купити</p><img src="images/basket.png"></button>
                                            <?php }
                                                unset($_SESSION['emptySize']);?>
                                        </form>
                                    </div>
                                </div>
                    <?php  }
                $connection-> close();
            ?>
        </div>
    </div>
</div>

<?php require "footer.php"?>
