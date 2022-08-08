<?php
    require "header.php";

    global $connection;
    $cart = $_SESSION['cart'];
?>

<div class="registration-cont">
    <div class="content">
        <div class="registration">
            <div class="registration-left">
                <p class="registration-name">Оформлення замовлення</p>
                <form class="registration-form" action="send/order_send.php" method="post">
                    <div class="registration-input-cont">
                        <div class="order-product-cont">
                            <?php foreach ($cart as $id => $size) {
                                $query = "SELECT * FROM products WHERE id='$id'";
                                global $connection;
                                $products = $connection->query($query);
                                while ($product = $products->fetch_assoc()) { ?>
                                    <div  class="itm-cont">
                                        <div  class='itm'>
                                            <div class='itm-el'><img src='<?= $product['product_img']?>' alt=''></div>
                                            <div class='itm-el txt'><?= $product['product_name']?></div>
                                            <div class='itm-el txt'><?= $size?></div>
                                            <div class='itm-el txt'><?= $product['product_price']?>₴</div>
                                        </div>
                                    </div>
                                <?php $arrPrice[] = $product['product_price'];} } ?>
                            <div  class="itm-cont" id="title-basket">
                                <div  class='itm'>
                                    <div class='itm-el txt'>Всього до сплати: <span> <?=array_sum($arrPrice) . '₴';?></span></div>
                                </div>
                            </div>
                        </div>
                        <div id="delivery">
                            <p class="frm">Cпосіб оплати</p>
                            <img src="images/grn.png" alt="">
                                <select name="payment">
                                    <?php
                                        $paymentArray = ['', 'Повна передплата', 'Передплата в розмірі 150 ₴'];
                                        foreach($paymentArray as $name) {
                                            if($name == $_SESSION['payment']) {
                                                echo "<option selected='selected' value='".$name."'>".$name."</option>";
                                            }
                                            else {
                                                echo "<option value='".$name."'>".$name."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            <div class="error-form"><?=$_SESSION['error_payment']??''?></div>
                        </div>
                        <div id="delivery">
                            <p class="frm">Cпосіб доставки</p>
                            <img src="images/dostavka.png" alt="">
                                <select name="delivery">
                                    <?php
                                        $deliveryArray = ['', 'Нова Пошта', 'Укрпошта', 'Meest'];
                                        foreach($deliveryArray as $name) {
                                            if($name == $_SESSION['delivery']) {
                                                echo "<option selected='selected' value='".$name."'>".$name."</option>";
                                            }
                                            else {
                                                echo "<option value='".$name."'>".$name."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            <div class="error-form"><?=$_SESSION['error_delivery']??''?></div>
                        </div>
                        <div class="registration-input-field" id="phone-cont">
                            <p class="frm">Введіть номер Вашого телефону</p>
                            <input class="registration-label" id="phone" type="phone" name="phone" value="<?=$_SESSION['phone']??''?>" placeholder="+38 (0__) ___ __ __">
                            <img src="images/phoneNumber.png" alt="">
                            <div class="error-form"><?=$_SESSION['error_phone']??''?></div>
                        </div>
                        <div class="registration-input-field">
                            <input class="registration-label" type="text" name="fio" value="<?=$_SESSION['fio']??''?>" placeholder="Введіть Ваше ПІБ">
                            <img src="images/fio.png" alt="">
                            <div class="error-form"><?=$_SESSION['error_name']??''?></div>
                        </div>
                        <div class="registration-input-field">
                            <input class="registration-label" type="text" name="addressTo" value="<?=$_SESSION['address']??''?>" placeholder="Введіть адресу доставки">
                            <img src="images/adress.png" alt="">
                            <div class="error-form"><?=$_SESSION['error_address']??''?></div>
                        </div>
                    </div>
                    <button class="registration-start" type="submit" value="Купити">Купити</button>
                </form>
            </div>
            <div class="registration-arrow"><img src="images/arrowReg.png" alt=""></div>
        </div>
    </div>
</div>

<?php require "footer.php"?>