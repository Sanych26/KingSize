<?php require "header.php"?>
<?php
    global $connection;
    $productId = (isset($_GET['product_id']) && intval($_GET['product_id']) > 0) ? intval($_GET['product_id']) : 0;
    $query = "SELECT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id)";
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
                            <div class="txt2 models-txt" id="galery-size">Розміри в наявності:<br>
                                <?php
                                    while ($size = $sizeProduct->fetch_assoc()){
                                        if ($size['size'] != NULL){
                                ?>
                                        <span class="txt2"><?= $size['size']?></span>
                                <?php  }else { ?>
                                        <span class="txt2">Немає в наявності</span>
                                <?php }
                                } ?>
                            </div>
                            <div class="buy-btn-cont">
                                <a href="order.php?product_id=<?=$product['id']?>"><button class="buy-btn" type="submit" name="buy">Купити</button></a>
                            </div>
                        </div>
                    <?php  }
                $connection-> close();
            ?>
        </div>
    </div>
</div>

<?php require "footer.php"?>
