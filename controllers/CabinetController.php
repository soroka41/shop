<?php

/**
 * Контроллер для работы с личным кабинетом
 */
class CabinetController {

    /**
     * Основная страница личного кабинета
     *
     * @return bool
     */
    public function actionIndex (){

        //Получаем id пользователя из сессии
        $userId = User::checkLog();

        //Получаем всю информацию о пользователе из БД
        $user = User::getUserById($userId);

        require_once(ROOT . '/views/cabinet/index.php');

        return true;
    }


    /**
     * Редактирование информации
     *
     * @return bool
     */
    public function actionEdit (){

        //Получаем id пользователя из сессии
        $userId = User::checkLog();

        $res = false;

        if (isset($_POST) and (!empty($_POST))) {
            $name = trim(strip_tags($_POST['name']));
            $password = trim(strip_tags($_POST['password']));

            //Флаг ошибок
            $errors = false;

            //Валидация полей
            if (!User::checkName($name)) {
                $errors[] = "Имя не может быть короче 2-х символов";
            }

            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не может быть короче 6-ти символов";
            }

            if ($errors == false) {
                $res = User::edit($userId, $name, $password);
            }
        }

        require_once(ROOT . '/views/cabinet/edit.php');

        return true;
    }

    /**
     * Просмотр истории заказов пользователя
     *
     * @return bool
     */
    public function actionOrdersList (){

        //Получаем id пользователя из сессии
        $userId = User::checkLog();

        $orders = Order::getOrdersListByUserId($userId);

        require_once(ROOT . '/views/cabinet/orders.php');

        return true;
    }
}