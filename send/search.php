<?php

    if (empty($_GET)){
        return;
    }
    $query = $_GET['query'] ?? '';
                    function search ()
                    {
                        global $connection;
                        global $query;
                        $query = trim($query);
                        $query = htmlspecialchars($query);

                        $all_result = $connection-> query("SELECT * FROM products WHERE product_art LIKE '%$query%' OR product_price LIKE '%$query%' OR product_name LIKE '%$query%' OR tags LIKE '%$query%'");
                ?>
                    <div class="categories"><div class="categories-txt">Результатів пошуку:<span><?= $all_result->num_rows;?></span></div></div>

                    <?php
                        while ($res = $all_result->fetch_assoc()){
                            $idProduct = $res['id'];
                            $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
                    ?>
                        <div class="product">
                            <img src="<?= $res['product_img']; ?>" alt="">
                            <div class="txt1"><?= $res['product_name']; ?></div>
                            <div class="txt2" id="galery-size"><p>Розмір:</p>
                                <?php
                                    while ($size = $sizeProduct->fetch_assoc()){
                                        if ($size['size'] != NULL){
                                ?>
                                        <span><?= $size['size']?></span>
                                <?php  }else { ?>
                                        <span class="txt2">Немає в наявності</span>
                                <?php }
                                }
                                ?>
                            </div>
                            <div class="txt2" id="galery-price">Ціна:<span><?= $res['product_price']; ?> ₴</span></div>
                            <div class="more-btn-cont">
                                <a href="/product.php?product_id=<?=$res['id']?>"><button class="more-btn">Більше</button></a>
                            </div>
                        </div>
                        <?php
                            }
                        }

                ?>