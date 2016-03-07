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
                <li><a href="category/<?php echo $catItem['id']?>">
                        <?php echo $catItem['name']?>
                </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!--main content-->
        <div class="content">
            <div class="features_items">
                <h2>Последние товары</h2>
                <!--single item-->
                <?php foreach($latestProducts as $singleItem): ?>
                <div class="item">
                    <?php
                    if($singleItem['is_new'])
                        echo "<img alt='' src='template/images/new.png' class='new'/>";
                    ?>
                    <a target="_blank" href="/product/<?php echo $singleItem['id']?>">
                    <img width="268px" height="249px" alt="" src="<?php echo Product::getImage($singleItem['id']); ?>" />
                    </a>
                    <p class="item_price"><?php echo $singleItem['price'] ?>&nbspгрн</p>
                    <a target="_blank" href="/product/<?php echo $singleItem['id']?>">
                        <p class="item_name"><?php echo $singleItem['name']?></p>
                    </a>
                    <a href="#" class="to_cart" data-id="<?php echo $singleItem['id'];?>">
                        В корзину
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<div class="appendix"></div>

<?php
include (ROOT . '/views/parts/footer.php');
?>
