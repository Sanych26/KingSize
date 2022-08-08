<?php
    require 'admin_header.php';

    if (!$_SESSION['login']){
        header("Location: ../admin.php");
        exit;
    }
?>

    <div class="orders-cont">
        <div class="main-text2">Список замовлень</div>
            <div class="categories">
                <?php
                    global $connection;
                    if (empty($_GET['status'])){
                        return;
                    }
                    $statusId = $_GET['status'];
                    $activeAct = ($_GET['status'] == 'Активне' ? 'active_cat' : '');
                    $activeDone = ($_GET['status'] == 'Виконане' ? 'active_cat' : '');
                    $orders = $connection->query("SELECT * FROM `orders` WHERE status = '$statusId'");
                ?>
                <div class="categories-txt"><span>Статус:</span></div>
                <a class="categories-txt <?=$activeAct?>" href="/admin/admin_orders.php?status=Активне">Активні</a>
                <a class="categories-txt <?=$activeDone?>" href="/admin/admin_orders.php?status=Виконане">Виконані</a>
                <div class="categories-txt ">Кількість замовлень:<span><?=$orders->num_rows;?></span></div>
            </div>

            <?php
                 while($order = $orders->fetch_assoc()){
            ?>
                       <div class="itm">
                           <div class="text">Дата:<span><?=$order['date']?></span></div>
                           <div class="text">Товар:<span>#<?=$order['product_id']?></span></div>
                           <div class="text">Розмір:<span><?=$order['order_size']?></span></div>
                           <div class="text">Спосіб оплати:<span><?=$order['order_payment']?></span></div>
                           <div class="text">Спосіб доставки:<span><?=$order['order_delivery']?></span></div>
                           <?php
                                if ($order['order_phone'] !== ''){
                           ?>
                                <div class="text">Номер телефону:<span><?=$order['order_phone']?></span></div>
                                <?php } ?>
                                <div class="text">ПІБ замовника:<span><?=$order['order_fio']?></span></div>
                                <div class="text">Адреса доставки:<span><?=$order['order_address']?></span></div>
                                <div class="done-order-cont">
                                    <a class="done-order" id="done" href="/admin/update-order.php?action=changeStatus&status=Виконане&id=<?=$order['id']?>"></a>
                                    <a class="done-order" id="delete" href="/admin/delete_order.php?action=deleteOrder&id=<?=$order['id']?>"></a>
                                </div>
                       </div>
                     <?php
                 }
            ?>

    </div>

<?php require 'admin_footer.php'; ?>