<?php
    require 'header.php';
    require 'send/search.php';
?>

    <div class="shop-cont container">
        <div class="content">
            <div class="container" id="search-cont">
                <form class="search-cont" method="get">
                    <div class="search-input">
                        <img src="images/search.png">
                        <input id="search-input" type="text" name="query" value="<?= $_GET['query']??''?>" placeholder="Введіть модель...">
                        <div id="clear-search"><img src="images/esc.png" alt=""></div>
                    </div>
                    <button class="filter-btn" type="submit">Пошук</button>
                </form>
            </div>
            <div class="product-cont">
                <?php
                    global $query;
                        if ($query == '') {
                        }else {
                            search();
                        }
                ?>
            </div>

            <div class="product-cont"></div>



            <div class="categories">
                    <?php
                        global $connection;
                        $limit = $_GET['limit'];
                            switch ($limit) {
                                case 10:
                                    $activeLim1 = 'active_lim';
                                    break;
                                case 20:
                                    $activeLim2 = 'active_lim';
                                    break;
                                case 30:
                                    $activeLim3 = 'active_lim';
                                    break;
                                case 40:
                                    $activeLim4 = 'active_lim';
                                    break;
                                case 50:
                                    $activeLim5 = 'active_lim';
                                    break;
                            }

                        $categoryId = (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) ? intval($_GET['category_id']) : 0;
                        $queryAll = "SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id)";
                        $query = "SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id)";
                            if ($categoryId > 0){
                                $query .= "WHERE categoryOfProduct.category_id = $categoryId LIMIT $limit";
                                $queryAll .= "WHERE categoryOfProduct.category_id = $categoryId";
                            }else{
                                $query = "SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id) LIMIT $limit";
                            }
                                $allProducts = $connection-> query($queryAll);
                                $products = $connection-> query($query);
                    ?>
                        <div class="categories-txt">Товарів в категорії:<span><?= $allProducts->num_rows;?></span></div>
            </div>


            <div class="product-cont">
                <?php
                    while ($product = $products->fetch_assoc()) {
                        $idProduct = $product['id'];
                        $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
                ?>
                         <div class="product">
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
                            <div class="more-btn-cont">
                                <a href="/product.php?product_id=<?=$product['id']?>"><button class="more-btn">Більше</button></a>
                            </div>
                        </div>
                    <?php  }
                    function pagination()
                    {
                        global $categoryId;
                        if (!empty($_GET['category_id'])){
                            echo "?category_id=$categoryId&";
                        }else{
                            echo "?";
                        }
                    }
                ?>
                <div class="product-cont" id="pagination">
                    <a class="number <?=$activeLim1?>" href="<?php pagination()?>limit=10">1</a>
                    <a class="number <?=$activeLim2?>" href="<?php pagination()?>limit=20">2</a>
                    <a class="number <?=$activeLim3?>" href="<?php pagination()?>limit=30">3</a>
                    <a class="number <?=$activeLim4?>" href="<?php pagination()?>limit=40">4</a>
                    <a class="number <?=$activeLim5?>" href="<?php pagination()?>limit=50">5</a>
                </div>

            </div>

        </div>
    </div>

<?php require 'footer.php'?>
