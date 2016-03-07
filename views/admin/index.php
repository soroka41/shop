<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<div class="container_admin">
    <h4>Добрый день, администратор!</h4>

    <br/>

    <p>Вам доступны такие возможности:</p>

    <ul>
        <li><a target="_blank" href="/admin/product">Управление товарами</a></li>
        <li><a target="_blank" href="/admin/category">Управление категориями</a></li>
        <li><a target="_blank" href="/admin/orders">Управление заказами</a></li>
    </ul>
</div>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
