<?php
namespace Base;

/*разбирает $_SERVER['REQUEST_URI'] и выдаёт нам название контроллера и название экшена
который в нём нужно вызвать.
Делаем его так, чтобы если мы хотим - задаём урлы напрямую, а если они не заданы, то задаётся динамиески
*/
class Route
{
    private $controllerName;    //имя контроллера
    private $actionName;    //имя экшена
    private $processed = false; //флаг - чтобы разбирать URL только единожды
    private $routes;

    private function process() //основной метод, который распиливает request_uri
    {
        if (!$this->processed) {
            $parts = parse_url($_SERVER['REQUEST_URI']);    //записываем в переменную ведённый URL (записывается вместе с передаваемыми параметрами
            $path = $parts['path']; //выуживаем в переменную часть без параметров

//        Условие отвечает за статический роутинг (если такой путь есть в массиве routes - то..., в противном случае будем пытаться определить динамически.
            if (($route = $this->routes[$path] ?? null) !== null) { //когда нужно запроцессить роутинг мы сначала проверяем есть ли наш path в массиве routes
                $this->controllerName = $route[0];    //определяем внутренние переменные
                $this->actionName = $route[1];    //определяем внутренние переменные
            } else {
                $parts = explode('/', $path);
                $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[1]));
                $this->actionName = strtolower($parts[2] ?? 'Index');
            };
        }
        $this->processed = true;
    }

    public function addRoute($path, $controllerName, $actionName)   //добавляет в наши роуты имя контроллера и экшена, который нужно выполнить (добавляет статические роуты)
    {
        $this->routes[$path] = [ //routes превращается после этого в массив =)
            $controllerName,
            $actionName
        ];
    }

    public function getControllerName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->actionName . 'Action';
    }
}
