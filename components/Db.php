<?php

/**
 * Class Db инициализируем подключение к БД
 */
class Db {
    public static function getConnection(){
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include ($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['db_name']}";
        $db = new PDO($dsn, $params['user'], $params['pass']);
        $db->exec("set names utf8");
        $db->query("SET time_zone = 'Europe/Kiev'");

        return $db;
    }
}