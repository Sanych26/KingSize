<?php
    require "header.php";
    require  "send/filter_send.php";
?>

<div class="main">
    <div class="content">
        <div class="top-cont">
            <div class="slogan">
                <div class="step">Step by step<br />with <span>King Size</span>.</div>
                <p>Все починається, коли ти відкриваєш взуттєву коробку<br />Просто натисни та замов.</p>
            </div>
            <div class="sneaker">
                <div class="points"><img src="images/points.png" alt=""></div>
                <div class="square-cont"></div>
                <div class="square"><img src="images/nbV5.png" alt=""></div>
            </div>
        </div>
        <div class="container" id="filter">
            <div class="content">
                <form class="filter-cont" method="get">
                    <div class="filter-itm">
<!--                        <p>Бренд</p>-->
                        <select name="brand">
                            <?php
                                $array = ['Бренд', 'Adidas', 'Asics', 'Clarks', 'New Balance', 'Nike', 'Puma', 'Reebok', 'Saucony', 'Diadora'];
                                foreach($array as $name)
                                {
                                    if($name == $_SESSION['filter_brand'])
                                    {
                                        echo "<option selected='selected' value='".$name."'>".$name."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$name."'>".$name."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="filter-itm">
<!--                        <p>Розмір</p>-->
                        <select name="size">
                            <?php
                                $array = ['Розмір', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47'];
                                foreach($array as $name)
                                {
                                    if($name == $_SESSION['filter_size'])
                                    {
                                        echo "<option selected='selected' value='".$name."'>".$name."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$name."'>".$name."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="filter-itm" id="last-itm">
                        <p>Ціна:</p>
                        <select name="price-from">
                            <?php
                                $array = ['Від', '1199', '1399', '1699', '1999', '2299'];
                                foreach($array as $name)
                                {
                                    if($name == $_SESSION['filter_price_from'])
                                    {
                                        echo "<option selected='selected' value='".$name."'>".$name.' ₴'."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$name."'>".$name.' ₴'."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <span> — </span>
                        <select name="price-to">
                            <?php
                                $array = ['До', '1399', '1699', '1999', '2299', '2740'];
                                foreach($array as $name)
                                {
                                    if($name == $_SESSION['filter_price_to'])
                                    {
                                        echo "<option selected='selected' value='".$name."'>".$name.' ₴'."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$name."'>".$name.' ₴'."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="filter-btn-cont">
                        <button class="filter-btn" type="submit">Застосувати</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="product-cont">
            <?php
                global $brand , $male , $filterSize , $priceFrom , $priceTo;
                    if ($brand == 'Бренд' || $male == 'Стать' || $filterSize == 'Розмір'|| $priceFrom == 'Від' || $priceTo == 'До' || $brand == 0 || trim($priceFrom) >= trim($priceTo)) {
                    }else {
                        filter();
                    }
            ?>
        </div>


        <div class="container" id="features">
            <div class="main-text1">Особливості</div>
            <div class="main-text2">Ми пропонуємо краще в King Size</div>
            <div class="features-cont">
                <div class="features-element">
                    <img src="images/features1.png" alt="">
                    <div class="txt1">Якість</div>
                    <div class="txt2">Увесь асортиментний ряд складає виключно оригінальна продукція</div>
                </div>
                <div class="features-element">
                    <img src="images/features2.png" alt="">
                    <div class="txt1">Гнучкість</div>
                    <div class="txt2">Ви можете обрати зручний для Вас спосіб оплати</div>
                </div>
                <div class="features-element">
                    <img src="images/features3.png" alt="">
                    <div class="txt1">Швидка доставка</div>
                    <div class="txt2">Відправимо Ваш товар протягом години після оформлення</div>
                </div>
            </div>
            <div id="galeryID"></div>
        </div>

        <div id="galery">
            <div class="container">
                <div class="content">
                    <div class="main-text1">Галерея</div>
                    <div class="main-text2">На будь-який смак</div>
                        <?php
                            global $connection;
                            $query = "SELECT * FROM `products`";
                            $queryMob = "SELECT * FROM `products` WHERE product_name LIKE '%Adidas%'";
                            $products = $connection-> query($query);
                            $productsMob = $connection-> query($queryMob);
                        ?>
                        <div class="models-container">
                             <div class="my-slider" id="models">
                                 <?php
                                     $a = 0;
                                     while ($product = $products->fetch_assoc()) {
                                        $idProduct = $product['id'];
                                        $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
                                        if($a > 15) break; ?>
                                        <div class="galery-element">
                                            <a href="product.php?product_id=<?=$product['id']?>"><img src="<?= $product['product_img']; ?>" alt=""></a>
                                            <div class="txt1"><a href="product.php?product_id=<?=$product['id']?>"><?= $product['product_name']; ?></a></div>
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
                                            <div class="txt2" id="galery-price">Ціна:<span><?= $product['product_price']; ?> ₴</span></div>
                                        </div>
                                    <?php  $a++;
                                    }
                                    ?>
                             </div>
                        </div>
                        <div class="models-mob-container">
                                <div class="my-slider" id="models-mob">
                                    <?php
                                        $a = 0;
                                        while ($productMob = $productsMob->fetch_assoc()) {
                                            $idProduct = $productMob['id'];
                                            $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
                                            if($a > 10) break; ?>
                                                <div class="gallery-mob-cont">
                                                    <div class="galery-element">
                                                        <a href="product.php?product_id=<?=$productMob['id']?>"><img src="<?= $productMob['product_img']; ?>" alt=""></a>
                                                        <div class="txt1"><a href="product.php?product_id=<?=$productMob['id']?>"><?= $productMob['product_name']; ?></a></div>
                                                        <div class="txt2" id="galery-size"><p>Розмір:</p>
                                                            <?php
                                                            while ($size2 = $sizeProduct->fetch_assoc()){
                                                                if ($size2['size'] != NULL){
                                                                    ?>
                                                                    <span><?= $size2['size']?></span>
                                                                <?php  }else { ?>
                                                                    <span class="txt2">Немає в наявності</span>
                                                                <?php }
                                                            } ?>
                                                        </div>
                                                        <div class="txt2" id="galery-price">Ціна:<span><?= $productMob['product_price']; ?> ₴</span></div>
                                                        <div class="more-btn-cont">
                                                            <a href="product.php?product_id=<?=$productMob['id']?>"><button class="more-btn" type="submit" name="more_button" value="Більше">Більше</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php  $a++;
                                        }
                                    ?>
                                </div>
                            <div class="navContainer" id="models_mob_nav">
                                <?php
                                    for ($i = 0; $i < 10; $i++){
                                        echo "<div></div>";
                                    }
                                ?>
                            </div>
                        </div>
                </div>
            <div id="testimonialsID"></div>
            </div>
        </div>

        <div class="testimonials-cont">
            <div class="container">
                <div class="content">
                    <div class="main-text1">Відгуки</div>
                    <div class="main-text2">Робота на репутацію</div>
                    <div class="testimonial-img"><div class="background-mask"></div><img src="images/testimonials.png" alt="" /></div>
                    <div class="testimonials-slider">
                        <div id="testimonials">
                            <?php
                                $testimonials = $connection->query("SELECT * FROM `testimonials`");
                                while($testimonial = $testimonials->fetch_assoc()){
                            ?>
                                <div class="testimonial-element">
                                    <img src="<?=$testimonial['user_photo']?>" alt="">
                                    <div class="testimonial-name"><img src="../images/coma.png" alt=""><?=$testimonial['user_name']?></div>
                                    <div class="txt1"><?=$testimonial['user_text1']?></div>
                                    <div class="txt2"><?=$testimonial['user_text2']?></div>
                                </div>
                            <?php }?>
                        </div>
                        <div class="navContainer" id="testimonialsNav">
                            <?php
                                $tesNum = $testimonials->num_rows;
                                for ($i = 0; $i < $tesNum; $i++){
                                    echo "<div></div>";
                                }
                                $connection->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


<?php require "footer.php"?>
