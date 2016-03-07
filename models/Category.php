<?php

/**
 * Модель для работы с категориями
 */
class Category {

    /**
     * @return array список категорий
     */
    public static function getCategory () {
        $db = Db::getConnection();

        $sql = "SELECT id, name FROM category
                WHERE status = 1
                ORDER BY sort_order ASC";

        $res = $db->query($sql);

        $catList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $catList;
    }

    /**
     * Список категорий для админпанели
     * Возвращает массив всех категорий, включая те, у которых статус отображения = 0
     *
     * @return array
     */
    public static function getCategoryListAdmin () {

        $db = Db::getConnection();

        $sql = "SELECT id, name, sort_order, status FROM category
                ORDER BY sort_order ASC";

        $res = $db->query($sql);

        $catList = $res->fetchAll(PDO::FETCH_ASSOC);

        return $catList;
    }

    /**
     * Вместо числового статуса категории, отображаем определенную строку
     *
     * @param $status
     * @return string
     */
    public static function getStatusText ($status) {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    /**
     * Удаление категории(админка)
     *
     * @param $id
     * @return bool
     */
    public static function deleteCategoryById ($id) {
        $db = Db::getConnection();

        $sql = "
                DELETE FROM category WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    /**
     * Добавление категории(админка)
     *
     * @param $options массив параметров
     * @return bool
     */
    public static function addCategory ($options) {

        $db = Db::getConnection();

        $sql = "
                INSERT INTO category(name, sort_order, status)
                VALUES (:name, :sort_order, :status)
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $res->execute();
    }

    /**
     * Возвращаем инфу о категории по ее id
     *
     * @param $id
     * @return mixed
     */
    public static function getCategoryById ($id) {

        $db = Db::getConnection();

        $sql = "SELECT name, sort_order, status FROM category
                WHERE id = :id";

        $res = $db->prepare($sql);

        $res->bindParam(':id', $id);
        $res->execute();

        $catList = $res->fetch(PDO::FETCH_ASSOC);

        return $catList;
    }

    /**
     * Изменение категории(админка)
     *
     * @param $id
     * @param $options - новые параметры
     * @return bool
     */
    public static function editCategory ($id, $options) {

        $db = Db::getConnection();

        $sql = "
                UPDATE category
                SET
                    name = :name,
                    sort_order = :sort_order,
                    status = :status
                WHERE id = :id
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
    }
}