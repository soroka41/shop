<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
 */
class AdminProductController extends AdminBase {

    /**
     * Просмотр всех товаров
     *
     * @return bool
     */
    public function actionIndex () {

        //проверка доступа
        self::checkAdmin();

        //выводим список всех товаров
        $products = Product::getProductsList();

        require_once(ROOT . '/views/admin_product/index.php');

        return true;
    }

    /**
     * Удаление конкретного товара
     *
     * @param $id товара
     * @return bool
     */
    public function actionDelete ($id) {

        //проверка доступа
        self::checkAdmin();

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Product::deleteProductById($id);
            //и перенаправляем на страницу товаров
            header('Location: /admin/product');
        }

        require_once(ROOT . '/views/admin_product/delete.php');

        return true;
    }

    /**
     * Добавление товара
     *
     * @return bool
     */
    public function actionAdd () {

        //проверка доступа
        self::checkAdmin();

        //Список категорий для выпадающего списка
        $categories = Category::getCategoryListAdmin();

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['code'] = trim(strip_tags($_POST['code']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            $options['availability'] = trim(strip_tags($_POST['availability']));
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));

            //Если все ок, записываем новый товар
            $id = Product::addProduct($options);

            // Если запись добавлена
            if ($id) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папку, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            };

            header('Location: /admin/product');
        }


        require_once(ROOT . '/views/admin_product/add.php');

        return true;
    }

    /**
     * Редатирование товара
     *
     * @param $id
     * @return bool
     */
    public function actionEdit ($id) {

        //проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categories = Category::getCategoryListAdmin();

        //Получаем информацию о выбранном товаре
        $product = Product::getProductById($id);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['code'] = trim(strip_tags($_POST['code']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            $options['availability'] = trim(strip_tags($_POST['availability']));
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Product::editProduct($id, $options);

            // Если запись добавлена
            if ($id) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            };

            header('Location: /admin/product');
        }

        require_once(ROOT . '/views/admin_product/edit.php');

        return true;
    }
}