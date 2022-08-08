<?php
    require 'admin_header.php';
    require 'admin_product_search.php';

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }
?>

    <div class="orders-cont">
        <div class="main-text2">Робота з товарами</div>
        <div class="categories">
            <?php
                global $connection;
                $products = $connection->query("SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id) ORDER BY `id` DESC");
                $categor = $connection->query("SELECT * FROM `categories`");
            ?>
            <div class="categories-txt"><span>Розділ:</span></div>
                <a class="categories-txt active_cat" href="/admin/admin_email_send.php">Товари</a>
            <div class="categories-txt"></div>
        </div>
        <div class="add-cont">
            <div class="add-btn"></div>
            <p>Додати товар</p>
        </div>

        <form class="add-cont-form" method="post" action="add_product.php" enctype="multipart/form-data">
            <div class="itm">
                <div class="esc-nav"><img src="../images/esc.png" alt=""></div>
                <div class="error-form"><?=$_SESSION['product_err'] ?? ''?></div>
                <div class="text">Введіть назву товару:</div>
                <input type="text" name="name">
                <div class="text" >Введіть артикул:</div>
                <input id="add_product" type="text" name="art">

                <div class="text">Виберіть категорію:</div>
                <div class="check_cont">
                    <?php
                        while ($categ = $categor->fetch_assoc()){
                    ?>
                            <input id="add_product_check_cat" type="checkbox" name="category[]" value="<?=$categ['id']?>">
                            <label for="add_product_check_cat"><?=$categ['categor_name']?></label>
                    <?php }?>
                </div>

                <div class="text">Введіть ціну:</div>
                <input id="add_product" type="text" name="price">

                <div class="text">Введіть розміри:</div>
                <div class="text">
                    <div class="check_cont">
                        <?php
                            $arr = [35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'Універсальний'];
                            foreach ($arr as $value){
                        ?>
                            <input id="add_product_check" type="checkbox" name="size[]" value="<?=$value?>">
                            <label for="add_product_check"><?=$value?></label>
                        <?php }?>
                    </div>
                </div>

                <div class="text">Додайте головне фото:</div>
                <input type="file" name="main_photo">

                <div class="text">Додайте фото для галереї:</div>
                <input type="file" name="gallery[]" multiple>

                <div class="text">Додайте опис:</div>
                <textarea name="description" maxlength="1000"></textarea>

                <div class="text">Додайте теги:</div>
                <textarea name="tags" maxlength="500"></textarea>

                <button class="more-btn" type="submit">Додати</button>
            </div>
        </form>

        <div class="container" id="search-cont">
            <form class="search-cont" method="get">
                <div class="search-input">
                    <img src="../images/search.png">
                    <input id="search-input" type="text" name="query" value="<?= $_GET['query']??''?>" placeholder="Введіть модель...">
                    <div id="clear-search"><img src="../images/esc.png" alt=""></div>
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
        <div class="categories">
            <div class="categories-txt">Кількість товарів:<span><?=$products->num_rows;?></span></div>
        </div>
        <?php
            while($product = $products->fetch_assoc()){
                $idProduct = $product['id'];
                $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
                $categories = $connection->query("SELECT categories.categor_name FROM `categories` INNER JOIN categoryOfProduct ON (categoryOfProduct.category_id = categories.id) WHERE categoryOfProduct.product_id = '$idProduct'");
                $gallery = $connection->query("SELECT product_photo FROM `galleryProduct` WHERE product_id = '$idProduct'");
        ?>
            <div class="itm">
                <div class="text">ID товару:<span>#<?=$product['id']?></span></div>
                <div class="text">Артикул:<span><?=$product['product_art']?></span></div>
                <div class="text">Категорія:
                        <?php
                            while ($category = $categories->fetch_assoc()){
                        ?>
                            <span><?=$category['categor_name']?></span>
                        <?php }?>
                </div>
                <div class="text">Назва:<span><?=$product['product_name']?></span></div>
                <div class="text">Ціна:<span><?=$product['product_price']?> ₴</span></div>
                <div class="text">Розміри:
                    <span>
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
                    </span>
                </div>
                <div class="text">Головне фото:
                    <img class="admin-product-img" src="../<?=$product['product_img']?>">
                </div>
                <div class="text">Галерея:
                        <div class="text"></div>
                        <?php
                            while($slider = $gallery->fetch_assoc()){
                        ?>
                                <img class="admin-product-galerry" src="../<?=$slider['product_photo']?>">
                        <?php }?>
                </div>
                <div class="text">
                    <div class="text">Опис:<span><?=$product['description']?></span></div>
                </div>
                <div class="text">
                    <div class="text">Теги:<span><?=$product['tags']?></span></div>
                </div>

                <div class="done-order-cont">
                    <a class="done-order" id="edit" href="/admin/update_product.php?id=<?=$product['id']?>"></a>
                    <a class="done-order" id="delete" href="/admin/delete_product.php?id=<?=$product['id']?>"></a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php require 'admin_footer.php'; ?>