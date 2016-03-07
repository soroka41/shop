<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
<div class="container_admin">
    <a href="/admin/product/add" class="add_item">
        Добавить товар
    </a>
    <h4 id="admin_list_h4">Список товаров</h4>
    <table id="admin_product_list"cellspacing="0">
        <tr>
            <th>id товара</th>
            <th>Код товара</th>
            <th>Название</th>
            <th>Цена</th>
        </tr>

        <?php foreach ($products as $product):?>
        <tr>
            <td><?php echo $product['id']?></td>
            <td><?php echo $product['code']?></td>
            <td><?php echo $product['name']?></td>
            <td><?php echo $product['price']?></td>
            <td><a title="Редактировать" href="/admin/product/edit/<?php echo $product['id']?>" class="del">
                    <img src="../../template/images/edit.png" alt="">
                </a></td>
            <td><a title="Удалить" href="/admin/product/delete/<?php echo $product['id']?>" class="del">
                <img src="../../template/images/del.png" alt="">
            </a></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
