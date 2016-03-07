<?php
include (ROOT . '/views/parts/header.php');
?>
<section>
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
            <div class="single_product">
                <div class="product_info">
                    <div class="single_product_img">
                        <?php
                        if($product['is_new'])
                            echo "<img alt='' src='../../template/images/new.png' class='new'/>";
                        ?>
                        <img alt="" width="266px" src="<?php echo Product::getImage($product['id']); ?>" />
                    </div>
                    <div class="single_product_details">
                        <div class="single_product_details_main">
                            <h2><?php echo $product['name']?></h2>
                            <p class="code">Код товара: <?php echo $product['code']?></p>
                            <p class="item_price"><?php echo $product['price']?>&nbsp;грн</p>
                            <div id="input_div">
                                <a href="#" class="to_cart" data-id="<?php echo $product['id'];?>">
                                    В корзину
                                </a>
                            </div>
                            <p><b>Наличие:</b> На складе</p>
                            <p><b>Состояние:</b> Новое</p>
                            <p><b>Производитель: </b><?php echo $product['brand']?></p>
                        </div>
                    </div>
                </div>
                <div class="product_description">
                    <h3>Описание товара</h3>
                    <p>
                        <?php echo $product['description']?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
