<?php
    require 'admin_header.php';
    require 'admin_product_search.php';

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

    global $connection;
    $idProduct = $_GET['id'];
    $_SESSION['prodId'] = $idProduct;
    $products = $connection->query("SELECT DISTINCT products.* FROM `products` INNER JOIN categoryOfProduct ON (categoryOfProduct.product_id = products.id) WHERE categoryOfProduct.product_id = '$idProduct'");
    $categor = $connection->query("SELECT * FROM `categories`");
    $categories = $connection->query("SELECT categories.categor_name FROM `categories` INNER JOIN categoryOfProduct ON (categoryOfProduct.category_id = categories.id) WHERE categoryOfProduct.product_id = '$idProduct'");
    $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
?>

<div class="orders-cont" id="update-product">
    <div class="main-text2">Оновлення товару</div>

    <form method="post" action="update_product_send.php" enctype="multipart/form-data">
        <?php while ($product = $products->fetch_assoc()){ ?>
            <div class="itm">
                <div class="error-form"><?=$_SESSION['product_err'] ?? ''?></div>
                <div class="text">Назва товару:</div>
                <input type="text" name="name" value="<?= $product['product_name']?>">
                <div class="text" >Артикул:</div>
                <input id="add_product" type="text" name="art" value="<?= $product['product_art']?>">

                <div class="text">Категорії:</div>
                <div class="check_cont">
                    <div class="text"><span>Вибрані категорії:
                        <?php while ($cat = $categories->fetch_assoc()){
                                echo $cat['categor_name'] . ' ';
                            }
                            echo '</span></div>';
                            while ($categ = $categor->fetch_assoc()){ ?>
                                <input id="add_product_check_cat" type="checkbox" name="category[]" value="<?=$categ['id']?>">
                                <label for="add_product_check_cat"><?=$categ['categor_name']?></label>
                        <?php }?>
                </div>

                <div class="text">Ціна в ₴:</div>
                <input id="add_product" type="text" name="price"  value="<?= $product['product_price']?>">

                <div class="text">Розміри:</div>
                <div class="text">
                    <div class="check_cont">
                        <div class="text"><span>Вибрані розміри:
                        <?php while ($size = $sizeProduct->fetch_assoc()){
                            echo $size['size'] . ' ';
                        }
                        echo '</span></div>';
                        $arr = [35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'Універсальний', NULL];
                        foreach ($arr as $value){
                            ?>
                            <input id="add_product_check" type="checkbox" name="size[]" value="<?=$value?>">
                            <label for="add_product_check"><?=$value?></label>
                        <?php }?>
                    </div>
                </div>

                <div class="text">Опис:</div>
                <textarea name="description" maxlength="1000"><?= $product['description']?></textarea>

                <div class="text">Теги:</div>
                <textarea name="tags" maxlength="500"><?= $product['tags']?></textarea>

                <button class="more-btn" type="submit">Оновити</button>
            </div>
        <?php }?>
    </form>

</div>

<?php require 'admin_footer.php'?>