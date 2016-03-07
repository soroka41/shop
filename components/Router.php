<?php

/**
 * Class Router маршрутизатор
 */
class Router {
    private $routes;

    /**
     * Router constructor подключает маршруты
     */
    public function __construct () {
        $routesPath = ROOT . "/config/routes.php";
        $this->routes = include($routesPath);
    }

    /**
     * @return string текущий адрес запроса
     */
    private function getURI(){
        if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function start(){

        //получаем строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            //Сравниваем uriPattern и $uri
            if(preg_match("~$uriPattern~", $uri)){

                // Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                //Подключаем файл контроллера
                $controllerFile = ROOT . "/controllers/" . $controllerName . ".php";
                if(file_exists($controllerFile))
                    include_once($controllerFile);

                //Создаем объект контроллера и дергаем нужный action
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result !== null)
                    break;
            }
        }
    }
}