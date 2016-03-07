<?php

/**
 * Автозагрузка классов
 */
function __autoload ($className) {

    //директории, в которых будет идти поиск классов
    $arrayPath = array(
        '/models/',
        '/components/'
    );

    foreach ($arrayPath as $path) {
        $path = ROOT . $path . $className . '.php';

        if (is_file($path))
            include_once $path;
    }
}
