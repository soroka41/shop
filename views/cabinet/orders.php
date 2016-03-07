<?php
include(ROOT . '/views/parts/header.php');
?>

<section>
    <div class="container_admin">

        <h4 id="admin_list_h4">Ваши заказы</h4>
        <table id="user_order_list" cellspacing="0">
            <tr>
                <th>Номер заказа</th>
                <th>Дата оформления</th>
                <th>Товары в заказе</th>
                <th>Статус заказа</th>
            </tr>
            <?php foreach ($orders as $order) :
                //Вытягиваем JSON строку заказанных товаров и преобразуем в массив
                $productQuantity = json_decode($order['products'], true);
                //Выбираем ключи (id товаров)
                $productIds = array_keys($productQuantity);

                $products = Product::getProductsByIds($productIds);
                ?>

                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['formated_date']; ?></td>
                    <td>
                        <?php foreach ($products as $product): ?>

                            <a target="_blank" href="/product/<?php echo $product['id'];?>"><?php echo $product['name'];?></a>
                            <?php
                            echo "<span>Кол-во: </span>" . $productQuantity[$product['id']];
                            echo '<span>Цена: </span>' . $product['price']; echo ' грн';
                            echo "</br>";
                            ?>
                            <?php
                                //подсчитываем сумму по каждому товару и пишем в массив
                                $arr[] = $product['price'] * $productQuantity[$product['id']];

                                //считаем общую сумму всех товаров в заказе, с учетом их кол-ва
                                $totalValue = array_sum($arr);
                            ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo Order::getStatusText($order['status']); ?></td>
                </tr>
                <tr class="total_price">
                    <td colspan="4"><?php echo '<span>Сумма заказа: ' . $totalValue; echo' грн</span>';?></td>
                </tr>
                <?php
                    //Очищаем массив
                    $arr = array();
                ?>
            <?php endforeach; ?>
        </table>
    </div>
</section>
<div class="appendix"></div>

<?php
include(ROOT . '/views/parts/footer.php');
?>
