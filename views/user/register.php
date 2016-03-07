<?php
include (ROOT . '/views/parts/header.php');
?>

<section>
    <div class="container">
    <?php if($res):?>
        <h4 id="reg_thanks">Спасибо за регистрацию!</h4>
        <h3 id="reg_main">Вернуться на <a href="/" id="reg_main_a">Главную</a></h3>
    <?php else: ?>
        <?php if (isset($errors) && is_array($errors)):?>
            <ul class="errors">
                <?php foreach($errors as $error):?>
                    <li> - <?php echo $error;?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <form action="#" method="post" id="registration_form">
            <h2>Регистрация на сайте</h2>
            <input required type="text" name="name" placeholder="Введите имя" value="<?php echo $name?>">
            <input required type="email" name="email" placeholder="Введите e-mail" value="<?php echo $email?>">
            <input required type="password" name="password" placeholder="Введите пароль" value="<?php echo $password?>">
            <input type=submit name="submit" value="Регистрация" id="reg_btn">
        </form>
    <?php endif;?>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
