<?php
include (ROOT . '/views/parts/header.php');
?>
<section id="cart_section">
    <div class="container">
        <!--left sidebar-->
        <div class="sidebar">
            <h2>Категории</h2>
            <ul class="left_sidebar">
                <?php foreach ($categories as $catItem): ?>
                    <li><a href="/category/<?php echo $catItem['id']?>">
                            <?php echo $catItem['name']?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--main content-->
        <div class="content">
            <h2>Корзина</h2>

            <?php if ($res): ?>
                <p>Заказ оформлен. Мы Вам перезвоним.</p>
            <?php else: ?>

            <p>Выбрано товаров: <?php echo $totalQuantity; ?>, на сумму: <?php echo $totalPrice; ?> грн</p><br/>

            <?php if (!$res): ?>

            <?php if (isset($errors) && is_array($errors)):?>
                <ul class="errors" id="error_checkout">
                    <?php foreach($errors as $error):?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <form action="#" method="post" id="checkout_form">
                <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>
                <input required type="text" name="name" placeholder="Введите имя" value="<?php echo $userName;?>">
                <input required type="tel" name="tel" pattern="0([0-9]{2})([0-9]{7})" placeholder="Телефон в формате: 0(xx)-xxx-xx-xx">
                <textarea name="comment" placeholder="Комментарий к заказу"></textarea>
                <input type=submit name="submit" value="Оформить заказ" id="check_btn">
            </form>
            <?php endif;?>

            <?php endif;?>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
