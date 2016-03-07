<?php

/**
 * Class UserController для работы с пользователем
 */

class UserController {

    /**
     * Регистрация пользователя
     *
     * @return bool
     */
    public function actionRegister () {

        $res = false;
        $name = '';
        $email = '';
        $password = '';

        if (isset($_POST) and (!empty($_POST))) {
            $name = trim(strip_tags($_POST['name']));
            $email = trim(strip_tags($_POST['email']));
            $password = trim(strip_tags($_POST['password']));

            //Флаг ошибок
            $errors = false;

            //Валидация полей
            if (!User::checkName($name)) {
                $errors[] = "Имя не может быть короче 2-х символов";
            }

            if (!User::checkEmail($email)) {
                $errors[] = "Некорректный Email";
            }

            if (!User::checkPassword($password)) {
                $errors[] = "Пароль не может быть короче 6-ти символов";
            }

            if (User::checkEmailExists($email)) {
                $errors[] = "Такой email уже используется";
            }

            if ($errors == false) {
                $res = User::register($name, $email, password_hash($password, PASSWORD_DEFAULT));
            }
        }

        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    /**
     * Авторизация пользователя
     *
     * @return bool
     */
    public function actionLogin () {
        ob_start();

        $email = '';
        $password = '';

        if (isset($_POST) and (!empty($_POST))) {

            $email = trim(strip_tags($_POST['email']));
            $password = $_POST['password'];

            //Флаг ошибок
            $errors = false;

            //Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = "Некорректный Email";
            }

            //Проверяем, существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = "Пользователя с таким email или паролем не существует";
            }else{
                User::auth($userId); //записываем пользователя в сессию

                header("Location: /cabinet/"); //перенаправляем в личный кабинет
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    /**
     * Выход из учетной записи
     *
     * @return bool
     */
    public function actionLogout () {

        unset($_SESSION['user']);
        header('Location: /');

        return true;
    }
}