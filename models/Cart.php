<?php

/**
 * Модель для работы с корзиной покупателя
 */
class Cart {

    /**
     * Добавление товара в корзину
     *
     * @param $id - id товара
     * @return int - количество товаров в корзине
     */
    public static function addProduct ($id) {

        $id = intval($id);

        //Пустой массив для товаров в корзине (ключ - id товара, значение - кол-во)
        $productsInCart = array();

        //Если в корзине уже есть товары, заполняем массив
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        //Если товар уже есть в корзине, но пользователь добавляет еще один,
        //то увеличиваем количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            //Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::itemsCount();
    }

    /**
     * Считаем кол-во товаров в корзине(сессия)
     *
     * @return int
     */
    public static function itemsCount () {

        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else
            return 0;
    }

    /**
     * Вытягиваем массив товаров из сессии
     *
     * @return bool
     */
    public static function getProducts () {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }

        return false;
    }

    /**
     * Считам общую сумму товаров в корзине
     *
     * @param $products - информация о товарах из корзины
     * @return int
     */
    public static function getTotalPrice ($products) {

        $productsInCart = self::getProducts();

        $total = 0;

        if ($products) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }

            return $total;
        }
    }

    /**
     * Удаление товара из корзины
     *
     * @param $id
     */
    public static function deleteProduct ($id) {

        //Получаем массив с id и количеством товаро в корзине
        $productsInCart = self::getProducts();

        //удаляем нужный товар по 1 единице
        if ($productsInCart[$id] == 1) {
            unset($productsInCart[$id]);
        } else {
            $productsInCart[$id]--;
        }

        //записываем новый массив в сессию
        $_SESSION['products'] = $productsInCart;
    }

    /**
     * Очистка корзины
     */
    public static function clear () {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
}