<?php

/**
 * Class CatalogController
 * Контроллер для работы с каталогом товаров
 */
class CatalogController {

    /**
     * Отображает список всех товаров, отсортирован по дате добавления
     *
     * @param int $page текущая страница
     * @return bool
     */
    public function actionIndex ($page = 1) {

        //Вывод категорий
        $categories = Category::getCategory();

        $latestProducts = Product::getLatestProducts($page);

        //Общее кол-во товаров (для пагинации)
        $total = Product::getTotalProducts();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }

    /**
     * Просмотр товаров по выбранной категории
     *
     * @param $catId id категории
     * @param int $page текущая страница
     * @return bool
     */
    public function actionCategory($catId, $page = 1){

        //Список категорий
        $categories = Category::getCategory();

        //Товары из категории
        $categoryProduct = Product::getProductListByCatId($catId, $page);

        //Общее кол-во товаров в категории (для пагинации)
        $total = Product::getTotalProductsInCategory($catId);

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }
}