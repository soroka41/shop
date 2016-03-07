<?php

/**
 * Модель для работы с заказами
 */
class Order {

    /**
     * Сохранение заказа пользователя в БД
     *
     * @param $userName
     * @param $userPhone
     * @param $userText
     * @param $userId
     * @param $productsInCart
     * @return bool
     */
    public static function save ($userName, $userPhone, $userText, $userId, $productsInCart) {
        $db = Db::getConnection();

        //Преобразовываем массив товаров в строку JSON
        $productsInCart = json_encode($productsInCart);

        $sql = "
                INSERT INTO product_order(user_name, user_phone, user_comment, user_id, products)
                VALUES (:userName, :userPhone, :userText, :userId, :products)
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':userName', $userName, PDO::PARAM_STR);
        $res->bindParam(':userPhone', $userPhone, PDO::PARAM_INT);
        $res->bindParam(':userText', $userText, PDO::PARAM_STR);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->bindParam(':products', $productsInCart, PDO::PARAM_STR);

        return $res->execute();
    }

    /**
     * Список заказов (для админки)
     *
     * @return array
     */
    public static function getOrdersList () {

        $db = Db::getConnection();

        $sql = "
                SELECT id, user_name, user_phone,
                 DATE_FORMAT(`date`, '%d.%m.%Y %H:%i:%s') AS formated_date, status
                 FROM product_order ORDER BY id DESC
                ";

        $ordersList = array();

        $res = $db->query($sql);

        $ordersList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $ordersList;
    }

    /**
     * Строковое представление статуса заказа
     *
     * @param $status
     * @return string
     */
    public static function getStatusText ($status) {
        switch ($status) {
            case '1' :
                return 'Новый';
                break;
            case '2' :
                return 'В обработке';
                break;
            case '3' :
                return 'Доставляется';
                break;
            case '4' :
                return 'Закрыт';
                break;
        }
    }

    /**
     * Выбираем заказ по его id
     *
     * @param $id
     * @return mixed
     */
    public static function getOrderById ($id) {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = "SELECT id, user_name, user_phone, user_comment, user_id,
                DATE_FORMAT(`date`, '%d.%m.%Y %H:%i:%s') AS formated_date,
                products, status
                  FROM product_order WHERE id = :id
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем запрос
        $res->execute();

        // Возвращаем данные
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Изменение заказа(админка)
     *
     * @param $id
     * @param $userName
     * @param $userPhone
     * @param $userComment
     * @param $status
     * @return bool
     */
    public static function updateOrder ($id, $userName, $userPhone, $userComment, $status){

        $db = Db::getConnection();

        $sql = "
                UPDATE product_order
                SET
                    user_name = :name,
                    user_phone = :phone,
                    user_comment = :comment,
                    status = :status
                WHERE id = :id
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->bindParam(':name', $userName, PDO::PARAM_STR);
        $res->bindParam(':phone', $userPhone, PDO::PARAM_INT);
        $res->bindParam(':comment', $userComment, PDO::PARAM_STR);
        $res->bindParam(':status', $status, PDO::PARAM_STR);

        return $res->execute();
    }

    /**
     * Удадение заказа
     *
     * @param $id
     * @return bool
     */
    public static function deleteOrderById ($id) {

        $db = Db::getConnection();

        $sql = "
                DELETE FROM product_order WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    /**
     * Просмотр истории заказов для пользователя(личный кабинет)
     *
     * @param $id
     * @return array
     */
    public static function getOrdersListByUserId ($id) {

        // Соединение с БД
        $db = Db::getConnection();

        $sql = "SELECT id,
                DATE_FORMAT(`date`, '%d.%m.%Y %H:%i:%s') AS formated_date, status, products
                  FROM product_order WHERE user_id = $id
                  ORDER BY id DESC
               ";

        // Выполняем запрос
        $res= $db->query($sql);

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}