<?php

/**
 * Модель для работы с товарами
 */
class Product {

    //Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;


    /**
     * Получаем последние товары
     *
     * @param int $page
     * @return array
     */
    public static function getLatestProducts ($page = 1) {

        $limit = self::SHOW_BY_DEFAULT;

        //Задаем смещение
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = DB::getConnection();

        $sql = "
                SELECT id, name, price, is_new
                  FROM product
                    WHERE status = 1
                      ORDER BY id DESC
                        LIMIT :limit OFFSET :offset
                ";

        //Подготавливаем данные
        $res = $db->prepare($sql);
        $res->bindParam(':limit', $limit, PDO::PARAM_INT);
        $res->bindParam(':offset', $offset, PDO::PARAM_INT);

        //Выполняем запрос
        $res->execute();

        //Получаем и возвращаем результат
        $productsList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $productsList;
    }

    /**
     * Выводим товары по выбранной категории
     *
     * @param $catId id категории
     * @param $page  - текущая страница
     * @return array
     */
    public static function getProductListByCatId ($catId, $page = 1) {

        $limit = self::SHOW_BY_DEFAULT;

        //Задаем смещение
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = DB::getConnection();

        $sql = "
                SELECT id, name, price, is_new FROM product
                  WHERE status = 1 AND category_id = :category_id
                    ORDER BY id DESC LIMIT :limit OFFSET :offset
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':category_id', $catId, PDO::PARAM_INT);
        $res->bindParam(':limit', $limit, PDO::PARAM_INT);
        $res->bindParam(':offset', $offset, PDO::PARAM_INT);

        $res->execute();

        //Получение и возврат результатов

        $products = $res->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Выбираем товар по идентификатору
     *
     * @param $productId
     * @return mixed
     */
    public static function getProductById ($productId) {

        $db = Db::getConnection();

        $sql = "
               SELECT id, name, code, price, availability, brand,
                description, is_new, category_id, status FROM product
                    WHERE id = :id
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $productId, PDO::PARAM_INT);
        $res->execute();

        $products = $res->fetch(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Выборка товаров по массиву id
     *
     * @param $arrayIds
     * @return array
     */
    public static function getProductsByIds ($arrayIds) {

        $db = Db::getConnection();

        //Разбиваем пришедший массив в строку
        $stringIds = implode(',', $arrayIds);

        $sql = "
                SELECT id, name, code, price FROM product
                WHERE status = 1 AND id IN ($stringIds)
                ";

        $res = $db->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Выводит списко всех товраов
     *
     * @return array
     */
    public static function getProductsList () {

        $db = Db::getConnection();

        $sql = "
                SELECT id, name, code, price FROM product
                ORDER BY id ASC
                ";

        $res = $db->query($sql);

        $products = $res->fetchAll(PDO::FETCH_ASSOC);
        return $products;

        return $products;
    }

    /**
     * Удаление товара(админка)
     *
     * @param $id
     * @return bool
     */
    public static function deleteProductById ($id) {
        $db = Db::getConnection();

        $sql = "
                DELETE FROM product WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    /**
     * Добавление продукта
     *
     * @param $options - характеристики товара
     * @return int|string
     */
    public static function addProduct ($options) {

        $db = Db::getConnection();

        $sql = "
                INSERT INTO product(name, category_id, code, price, availability,
                                    brand, description, is_new, status)
                VALUES (:name, :category_id, :code, :price, :availability,
                        :brand, :description, :is_new, :status)
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':category_id', $options['category'], PDO::PARAM_INT);
        $res->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $res->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $res->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        //Если запрос выполнен успешно
        if ($res->execute()) {
            //Возвращаем id последней записи, позже, в контроллере переходим на страницу этого товара, если все успешно
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }

    /**
     * Изменение товара
     *
     * @param $id
     * @param $options
     * @return bool
     */
    public static function editProduct ($id, $options) {

        $db = Db::getConnection();

        $sql = "
                UPDATE product
                SET
                    name = :name,
                    category_id = :category,
                    code = :code,
                    price = :price,
                    availability = :availability,
                    brand = :brand,
                    description = :description,
                    is_new = :is_new,
                    status = :status
                WHERE id = :id
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':category', $options['category'], PDO::PARAM_INT);
        $res->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $res->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $res->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $res->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $res->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $res->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage ($id) {

        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    /**
     * Возвращаем количество товаров в указанной категории
     * @param integer $catId
     * @return integer
     */
    public static function getTotalProductsInCategory ($catId) {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        // Используется подготовленный запрос
        $res = $db->prepare($sql);
        $res->bindParam(':category_id', $catId, PDO::PARAM_INT);

        // Выполнение коменды
        $res->execute();

        // Возвращаем значение count - количество
        $row = $res->fetch();
        return $row['count'];
    }

    /**
     * Общее кол-во товаров в магазине
     *
     * @return mixed
     */
    public static function getTotalProducts () {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT count(id) AS count FROM product WHERE status=1 ";

        // Выполнение коменды
        $res = $db->query($sql);

        // Возвращаем значение count - количество
        $row = $res->fetch();
        return $row['count'];
    }
}