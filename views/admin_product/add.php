<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Добавить новый товар</h2>
            <form action="#" method="post" id="add_form" enctype="multipart/form-data">

                <p>Название товара</p>
                <input required type="text" name="name">

                <p>Код товара</p>
                <input required type="text" name="code">

                <p>Стоимость</p>
                <input required type="text" name="price">

                <p>Категория</p>
                <select name="category">
                    <?php if (is_array($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <p>Производитель</p>
                <input required type="text" name="brand">

                <p>Изображение товара</p>
                <input type="file" name="image">

                <p>Детальное описание</p>
                <textarea id="add_description" name="description"></textarea>

                <p>Наличие на складе</p>
                <select name="availability">
                    <option value="1" selected>Да</option>
                    <option value="0">Нет</option>
                </select>

                <p>Новинка</p>
                <select name="is_new">
                    <option value="1" selected>Да</option>
                    <option value="0">Нет</option>
                </select>

                <p>Статус</p>
                <select name="status">
                    <option value="1" selected>Отображается</option>
                    <option value="0">Скрыт</option>
                </select>
                <input type=submit name="submit" value="Сохранить" id="add_btn">
            </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
