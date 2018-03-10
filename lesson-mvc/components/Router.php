<?php

class Router
{
    // Будут хранится маршруты в виде массива
    private $routes;

    /**
     * Получаем из файла routes.php массив с роутами
     * и присваиваем закрытому свойству $routes
     *
     * Router constructor.
     */
    public function __construct()
    {
        // Путь к базовой директории и путь к роутам
        $routesPath = ROOT . '/config/routes.php';
        // После require_once в $this->routes хранится массив с роутами
        $this->routes = require_once($routesPath);
    }

    /**
     * Returns request string ( Возвращает строку запроса )
     *
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
//        echo '<pre>';
//        print_r($this->routes);
//        echo '</pre>';

        // 1. Получаем строку запроса
        $uri = $this->getURI();

        // 2. Проверяем наличие такого запроса в файле routes.php
        foreach ($this->routes as $uriPattern => $path) {
            // Сравниваем $uriPattern и $uri и если есть совпадение то в текущем
            // $path будет хранится строка с именем controller-а и action-а
            // "~$uriPattern~"
            if (preg_match("~\b$uriPattern\b~", $uri)) {
//                echo '<br> Где ищем (запрос котоорый набрал пользоваель): ' . $uri;
//                echo '<br> Что ищем (совпадение из правила): ' . $uriPattern;
//                echo '<br> Кто обрабатывает: ' . $path;
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
//                echo '<br> Нужно сформировать: ' . $internalRoute . '<br>';

                // 3. Если есть совпадение, определяем какой controller и action обрабатывают запрос

                // Разбиваем строку на 2 части чтобы отдельно получить
                // имя controller-а и action-а
                $segments = explode('/', $internalRoute);
                // Собираем по кусочкам имя controller-а
                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                // Собираем по кусочкам имя action-а
                $actionName = "action" . ucfirst(array_shift($segments));

//                echo '<br> Controller name: ' . $controllerName;
//                echo '<br> Action name: ' . $actionName;

                $parameters = $segments;
//                echo '<pre>';
//                print_r($parameters);

                // 4. Подключаем файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                }

                // 5. Создаем объект и вызываем нужный метод (т.е. action)
                $controllerObject = new $controllerName;
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }
}