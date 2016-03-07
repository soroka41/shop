<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Изменить заказ</h2>
        <form action="#" method="post" id="add_form">

            <p>Имя клиента</p>
            <input required type="text" name="name" value="<?php echo $order['user_name']?>">

            <p>Телефон клиента</p>
            <input required type="text" name="phone" value="<?php echo $order['user_phone']?>">

            <p>Комментарий к заказу</p>
            <input required type="text" name="comment" value="<?php echo $order['user_comment']?>">

            <p>Статус заказа</p>
            <select name="status">

                <option value="1" <?php if($order['status'] == 1) echo 'selected';?>>
                    Новый
                </option>

                <option value="2" <?php if($order['status'] == 2) echo 'selected';?>>
                    В обработке
                </option>

                <option value="3" <?php if($order['status'] == 3) echo 'selected';?>>
                    Доставляется
                </option>

                <option value="4" <?php if($order['status'] == 4) echo 'selected';?>>
                    Закрыт
                </option>
            </select>


            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
