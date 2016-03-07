<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container_admin_order_info">

        <h2>Просмотр заказа #<?php echo $orders['id'];?></h2>
        <h4>Информация о заказе</h4>

        <table id="admin_order_show" cellspacing="0">

            <tr>
                <td>Номер заказа :</td>
                <td><?php echo $orders['id'];?></td>
            </tr>

            <tr>
                <td>Имя клиента:</td>
                <td><?php echo $orders['user_name'];?></td>
            </tr>

            <tr>
                <td>Телефон клиента :</td>
                <td><?php echo $orders['user_phone'];?></td>
            </tr>

            <tr>
                <td>Комментарий клиента :</td>
                <td><?php echo $orders['user_comment'];?></td>
            </tr>

            <tr>
                <td>ID клиента :</td>
                <td><?php echo $orders['user_id'];?></td>
            </tr>

            <tr>
                <th>Дата заказа :</th>
                <td><?php echo $orders['formated_date'];?></td>
            </tr>

            <tr>
                <th>Статус заказа :</th>
                <td><?php echo Order::getStatusText($orders['status']);?></td>
            </tr>

        </table>

        <h3>Товары в заказе</h3>

        <table id="admin__order_product_list" cellspacing="0">

            <tr>
                <th>ID товара</th>
                <th>Код товара</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>

            <?php foreach ($products as $product):?>
                <tr>
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['code'];?></td>
                    <td><?php echo $product['name'];?></td>
                    <td><?php echo $product['price'];?></td>
                    <td><?php echo $productQuantity[$product['id']];?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
