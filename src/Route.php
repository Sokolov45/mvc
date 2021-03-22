<?php
namespace Base;

/*разбирает $_SERVER['REQUEST_URI'] и выданть нам название контроллера и название экшена
который в нём нужно вызвать.*/
class Route
{
    private $controllerName;
    private $actionName;
    private $processed = false;
    private $routes;

    private function process()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        $path = $parts['path'];
//        if (isset($this->routes[$path])) {
        if (($route = $this->routes[$path] ?? null) !== null) {
            $this->controllerName = $this->routes[$path][0];
            $this->actionName = $this->routes[$path][1];
        } else {
        };
        switch ($parts['path']) {
            case '/user/login':
                $controller = new \App\Controller\User();
                $controller->loginAction();
                break;

            case '/user/register':
                $controller = new \App\Controller\User();
                $controller->registerAction();
                break;

            case '/blog':
            case '/blog/index':
                $controller = new \App\Controller\Blog();
                $controller->indexAction();
                break;

            default:
                header("HTTP/1.0 404  ");
                break;
        };
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
        return $this->actionName;
    }
}