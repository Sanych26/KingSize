<?php
    require 'header.php';
    require_once 'functions.php';
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

            <div class="categories" id="product-panel">
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

                        if (isset($_GET['sort'])){
                            $sortStatus = $_GET['sort'];
                        } else{
                            $sortStatus = 0;
                            $_GET['sort'] = "date_up";
                        }
                        $categoryId = (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) ? intval($_GET['category_id']) : 0;
                        $queryAll = "SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id)";
                        $query = "SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id)";
                            if ($categoryId > 0) {
                                $query .= "WHERE categoryOfProduct.category_id = $categoryId ";
                                $queryAll .= "WHERE categoryOfProduct.category_id = $categoryId ";
                            }
                                switch ($sortStatus) {
                                    case NULL:
                                        $query .= "ORDER BY id DESC LIMIT $limit";
                                        $queryAll .= "ORDER BY id DESC";
                                        break;
                                    case "date_up":
                                        $query .= "ORDER BY id DESC LIMIT $limit";
                                        $queryAll .= "ORDER BY id DESC";
                                        break;
                                    case "date_down":
                                        $query .= "ORDER BY id ASC LIMIT $limit";
                                        $queryAll .= "ORDER BY id ASC";
                                        break;
                                    case "price_up":
                                        $query .= "ORDER BY product_price DESC LIMIT $limit";
                                        $queryAll .= "ORDER BY product_price DESC";
                                        break;
                                    case "price_down":
                                        $query .= "ORDER BY product_price ASC LIMIT $limit";
                                        $queryAll .= "ORDER BY product_price ASC";
                                        break;
                                }

                                $allProducts = $connection-> query($queryAll);
                                $products = $connection-> query($query);
                    ?>
                        <div class="categories-txt">Товарів в категорії:<span><?=$allProducts->num_rows;?></span></div>
                        <div class="filter-itm" id="sorting">
                            <img id="sort_arrow" src="images/sorting.png">
                            <div class="categories-txt">Сортувати:
                                <span>
                                    <script>
                                            function sorting(choice)
                                            {
                                                if ('URLSearchParams' in window) {
                                                    var url = new URL(window.location.href);
                                                    var search_params = url.searchParams;

                                                    search_params.set('sort', choice);
                                                    url.search = search_params.toString();
                                                    var new_url = url.toString();
                                                    return new_url;
                                                }
                                            }
                                    </script>
                                    <form method="get">
                                        <select name="sort" onchange="location.href = sorting(this.value);">
                                           <?php
                                                $array = ['price_up' => 'від дорогих до дешевих', 'price_down' => 'від дешевих до дорогих', 'date_up' => 'по даті спадання', 'date_down' => 'по даті зростання'];
                                                foreach ($array as $sort => $sort_name) {
                                                    if($sort == $_GET['sort']) {
                                                        echo "<option selected='selected' value='".$sort."'>".$sort_name."</option>";
                                                    } else {
                                                        echo "<option value='".$sort."'>".$sort_name."</option>";
                                                    }
                                                }
                                           ?>
                                        </select>
                                    </form>
                                </span>
                            </div>
                        </div>
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
                    <a class="number <?=$activeLim1 ?? ''?>" href="<?php pagination()?>limit=10&sort=<?=$_GET['sort']?>">1</a>
                    <a class="number <?=$activeLim2 ?? ''?>" href="<?php pagination()?>limit=20&sort=<?=$_GET['sort']?>">2</a>
                    <a class="number <?=$activeLim3 ?? ''?>" href="<?php pagination()?>limit=30&sort=<?=$_GET['sort']?>">3</a>
                    <a class="number <?=$activeLim4 ?? ''?>" href="<?php pagination()?>limit=40&sort=<?=$_GET['sort']?>">4</a>
                    <a class="number <?=$activeLim5 ?? ''?>" href="<?php pagination()?>limit=50&sort=<?=$_GET['sort']?>">5</a>
                </div>

            </div>

        </div>
    </div>

<?php require 'footer.php'?>