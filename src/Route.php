<?php
namespace Base;

/*разбирает $_SERVER['REQUEST_URI'] и выданть нам название контроллера и название экшена
который в нём нужно вызвать.
Делаем его так, чтобы если мы хотим - задаём урлы напрямую, а если они не заданы, то задаётся динамиески
*/
class Route
{
    private $controllerName;
    private $actionName;
    private $processed = false; //флаг
    private $routes;

    private function process()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        $path = $parts['path'];

//        эта часть отвечает за статический роутинг, в противном случае будем пытаться определить динамически
        if (($route = $this->routes[$path] ?? null) !== null) { //когда нужно запроцессить роутинг мы сначала проверяем есть ли наш path  в массиве routes
            $this->controllerName = $route[0];    //определяем внутренние переменные
            $this->actionName = $route[1];    //определяем внутренние переменные
        } else {
            $parts = explode('/', $path);
            var_dump($parts);
            $this->controllerName = '\\App\\Controller' . ucfirst(strtolower($parts[1]));
            $this->actionName = strtolower($parts[2] ?? 'index');

            if (!class_exists($this->controllerName)) {
                throw new RouteException('ne mogu naiti controller' . $this->controllerName);
            }


        };
//        switch ($parts['path']) {
//            case '/user/login':
//                $controller = new \App\Controller\User();
//                $controller->loginAction();
//                break;
//
//            case '/user/register':
//                $controller = new \App\Controller\User();
//                $controller->registerAction();
//                break;
//
//            case '/blog':
//            case '/blog/index':
//                $controller = new \App\Controller\Blog();
//                $controller->indexAction();
//                break;
//
//            default:
//                header("HTTP/1.0 404  ");
//                break;
//        };
    }

//    добавляет в наши роуты имя контроллера и экшена, который нужно выполнить
    public function addRoute($path, $controllerName, $actionName)
    {
        $this->routes[$path] = [
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