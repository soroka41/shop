<?php

// FRONT CONTROLLER
if (function_exists('date_default_timezone_set'))
date_default_timezone_set('Europe/Kiev');
// 1. Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

//Запускаем сессию
session_start();

//2. Поключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

//3. Запускаем маршрутизатор
$router = new Router();
$router->start();