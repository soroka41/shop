<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Изменить категорию</h2>
        <form action="#" method="post" id="add_form">

            <p>Название Категории</p>
            <input required type="text" name="name" value="<?php echo $category['name']?>">

            <p>Порядковый номер</p>
            <input required type="text" name="sort_order" value="<?php echo $category['sort_order']?>">

            <p>Статус</p>
            <select name="status">
                <option value="1" <?php if($category['status'] == 1) echo 'selected'?>>Отображать</option>
                <option value="0" <?php if($category['status'] == 0) echo 'selected'?>>Скрывать</option>
            </select>

            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
