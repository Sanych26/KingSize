<?php
    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }

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
        $all_result = $connection-> query("SELECT * FROM products WHERE id LIKE '%$query%' OR product_art LIKE '%$query%' OR product_price LIKE '%$query%' OR product_name LIKE '%$query%'");
        ?>
        <div class="categories"><div class="categories-txt">Результатів пошуку:<span><?= $all_result->num_rows;?></span></div></div>

        <?php
            while ($res = $all_result->fetch_assoc()){
                $idProduct = $res['id'];
                $sizeProduct =  $connection-> query("SELECT * FROM `sizeProduct`  WHERE product_id = '$idProduct';");
                $categories = $connection->query("SELECT categories.categor_name FROM `categories` INNER JOIN categoryOfProduct ON (categoryOfProduct.category_id = categories.id) WHERE categoryOfProduct.product_id = '$idProduct'");
                $gallery = $connection->query("SELECT product_photo FROM `galleryProduct` WHERE product_id = '$idProduct'");
        ?>
            <div class="itm">
                <div class="text">ID товару:<span>#<?=$res['id']?></span></div>
                <div class="text">Артикул:<span><?=$res['product_art']?></span></div>
                <div class="text">Категорія:
                    <?php
                    while ($category = $categories->fetch_assoc()){
                        ?>
                        <span><?=$category['categor_name']?></span>
                    <?php }?>
                </div>
                <div class="text">Назва:<span><?=$res['product_name']?></span></div>
                <div class="text">Ціна:<span><?=$res['product_price']?> ₴</span></div>
                <div class="text">Розміри:<span>
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
                    </span></div>
                <div class="text">Головне фото:
                    <img class="admin-product-img" src="../<?=$res['product_img']?>">
                </div>
                <div class="text">Галерея:
                    <div class="text">
                        <div class="text"></div>
                        <?php
                           while($slider = $gallery->fetch_assoc()){
                        ?>
                            <img class="admin-product-galerry" src="../<?=$slider['product_photo']?>">
                        <?php }?>
                    </div>
                </div>
                <div class="done-order-cont">
                    <a class="done-order" id="edit" href="/admin/update-order.php?id=<?=$res['id']?>"></a>
                    <a class="done-order" id="delete" href="/admin/delete_product.php?id=<?=$res['id']?>"></a>
                </div>
            </div>
            <?php
        }
    }
?>