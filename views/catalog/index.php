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
            <div class="features_items">
                <h2>Последние товары</h2>
                <!--single item-->
                <?php foreach($latestProducts as $latestProduct):?>
                <div class="item">
                    <?php
                    if($latestProduct['is_new'])
                        echo "<img alt='' src='../../template/images/new.png' class='new'/>";
                    ?>
                    <a target="_blank" href="/product/<?php echo $latestProduct['id']?>">
                        <img alt="" width="268px" height="249px" src="<?php echo Product::getImage($latestProduct['id']); ?>" />
                    </a>
                    <p class="item_price"><?php echo $latestProduct['price']?>&nbspгрн</p>
                    <a target="_blank" href="/product/<?php echo $latestProduct['id']?>">
                    <p class="item_name"><?php echo $latestProduct['name']?></p>
                    </a>
                    <a href="#" class="to_cart" data-id="<?php echo $latestProduct['id'];?>">
                        В корзину
                    </a>
                </div>
                <?php endforeach;?>
            </div>
            <div class="pagination">
                <?php echo $pagination->get();?>
            </div>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php
include (ROOT . '/views/parts/footer.php');
?>
