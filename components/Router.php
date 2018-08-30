<?php

class Router
{
    private $routes;//свойство класса относящееся к routes.php

    public function __construct() //выстраиваем путь к routes.php и подключаем в данный класс
    {
        $routePath = ROOT . '/config/routes.php';
        $this->routes = include($routePath);
    }

    private function getUri()  //метод чтобы взять uri и обрезать лишние пробелы и слэши
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() //метод для маршрутизации в контроллер и вызова action методов
    {
        $uri = $this->getUri();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute); //разбиваем на элементы
                $controllerName = ucfirst(array_shift($segments) . 'Controller'); //выбираем первый элемент и делаем с большой буквы и конкатинируем с Controller
                $actionName = 'action' . ucfirst(array_shift($segments)); //делаем тоже самое добавляя action
                $parameters = $segments;
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php'; //формируем путь к контроллеру
                if (file_exists($controllerFile)) {
                    include_once($controllerFile); //подключаем файл контроллера
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array([$controllerObject, $actionName], $parameters); //Вызовет у нашего объекта какой-то action

                if ($result != NULL) {
                    break;
                }
            }
        }
    }
}