<?php

//    unset($_SESSION['error_brand']);
//    unset($_SESSION['error_male']);
//    unset($_SESSION['error_size']);
//    unset($_SESSION['error_price']);

    if (empty($_GET)){
        return;
    }


    $brand = $_GET['brand'] ;
    $filterSize = $_GET['size'];
    $priceFrom = $_GET['price-from'];
    $priceTo = $_GET['price-to'];


    $_SESSION['filter_brand'] = $brand;
    $_SESSION['filter_size'] = $filterSize;
    $_SESSION['filter_price_from'] = $priceFrom;
    $_SESSION['filter_price_to'] = $priceTo;


    function filter()
    {
        global $connection;
        $brand = $_SESSION['filter_brand'] ?? '';
        $priceFrom = $_SESSION['filter_price_from'] ?? '';
        $priceTo = $_SESSION['filter_price_to'] ?? '';
        $filterSize = $_SESSION['filter_size'] ?? '';

        //INNER JOIN brandOfProduct ON brandOfProduct.brand_id = brands.id AND brands.title = '$brand'
        $filter_result = $connection-> query("SELECT products.*  FROM `products` INNER JOIN sizeProduct ON sizeProduct.product_id = products.id AND sizeProduct.size = '$filterSize'  WHERE product_price BETWEEN '$priceFrom' AND '$priceTo' AND product_name LIKE '%$brand%'");
        ?>
        <div class="categories"><div class="categories-txt">Результатів пошуку:<span><?= $filter_result->num_rows;?></span></div></div>

        <?php
        while ($res = $filter_result->fetch_assoc()){
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
                    } ?>
                </div>
                <div class="txt2" id="galery-price">Ціна:<span><?= $res['product_price']; ?> ₴</span></div>
                <div class="more-btn-cont">
                    <a href="/product.php?product_id=<?=$res['id']?>"><button class="more-btn">Більше</button></a>
                </div>
            </div>
            <?php
        }
        unset($_SESSION['filter_brand']);
        unset($_SESSION['filter_male']);
        unset($_SESSION['filter_size']);
        unset($_SESSION['filter_price_from']);
        unset($_SESSION['filter_price_to']);
    }

?>