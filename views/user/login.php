<?php
include (ROOT . '/views/parts/header.php');
?>

<section>
    <div class="container">

            <?php if (isset($errors) && is_array($errors)):?>
                <ul class="errors">
                    <?php foreach($errors as $error):?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>

            <form action="#" method="post" id="enter_form">
                <h2>Вход на сайт</h2>
                <input required type="email" name="email" placeholder="Введите e-mail"">
                <input required type="password" name="password" placeholder="Введите пароль">
                <input type=submit name="submit" value="Вход" id="enter_btn">
            </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
