<?php

/**
 * Class ProductController
 * Контроллер для отображения единичного товара
 */
class ProductController {

    public static function actionView ($productId) {

        //Список категорий
        $categories = Category::getCategory();

        //Товар
        $product = Product::getProductById($productId);

        require_once(ROOT . '/views/single_item/single_item.php');
        return true;
    }
}