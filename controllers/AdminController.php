<?php

/**
 * Контроллер главной страницы админки
 */
class AdminController extends AdminBase{
    public function actionIndex (){

        //проверка доступа
        self::checkAdmin();

        require_once(ROOT . '/views/admin/index.php');

        return true;
    }
}