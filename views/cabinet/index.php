<?php
include(ROOT . '/views/parts/header.php');
?>
<section>
    <div class="container">
        <h2>Личный кабинет</h2>
        <h4 id="cabinet_greeting">Привет, <?php echo $user['name']; ?></h4>
        <ul id="cabinet_list">
           <li><a target="_blank" href="/cabinet/edit">Редактировать персональные данные</a></li>
           <li><a target="_blank" href="/cabinet/orders">Список покупок</a></li>
        </ul>
    </div>
</section>
<div class="appendix"></div>
<?php
include(ROOT . '/views/parts/footer.php');
?>
