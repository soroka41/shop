<?php
include (ROOT . '/views/parts/header_admin.php');
?>

<section>
    <div class="container">
        <h2>Редактировать товар #<?php echo $product['id']?></h2>
        <form action="#" method="post" id="add_form" enctype="multipart/form-data">

            <p>Название товара</p>
            <input required type="text" name="name" value="<?php echo $product['name']?>">

            <p>Код товара</p>
            <input required type="text" name="code" value="<?php echo $product['code']?>">

            <p>Стоимость</p>
            <input required type="text" name="price" value="<?php echo $product['price']?>">

            <p>Категория</p>
            <select name="category">
                <?php if (is_array($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"
                            <?php if ($product['category_id'] == $category['id']) echo ' selected'; ?>>
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <p>Производитель</p>
            <input required type="text" name="brand" value="<?php echo $product['brand']?>">

            <p>Изображение товара</p>
            <img src="<?php echo Product::getImage($product['id']); ?>" width="200" alt="" />
            <input type="file" name="image">

            <p>Детальное описание</p>
            <textarea id="add_description" name="description"><?php echo $product['description']?></textarea>

            <p>Наличие на складе</p>
            <select name="availability">
                <option value="1" <?php if($product['availability'] == 1) echo 'selected'?>>Да</option>
                <option value="0" <?php if($product['availability'] == 0) echo 'selected'?>>Нет</option>
            </select>

            <p>Новинка</p>
            <select name="is_new">
                <option value="1" <?php if($product['is_new'] == 1) echo 'selected'?>>Да</option>
                <option value="0" <?php if($product['is_new'] == 0) echo 'selected'?>>Нет</option>
            </select>

            <p>Статус</p>
            <select name="status">
                <option value="1" <?php if($product['status'] == 1) echo 'selected'?>>Отображается</option>
                <option value="0" <?php if($product['status'] == 0) echo 'selected'?>>Скрыт</option>
            </select>
            <input type=submit name="submit" value="Сохранить" id="add_btn">
        </form>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer_admin.php');
?>
