<?php
namespace Base;

class Application
{
    private $route;
    /** @var  AbstractController */
    private $controller;
    private $actionName;


    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        try {
            $this->addRoutes();
            $this->initController();
            $this->initAction();

            $view = new View();
            $this->controller->setView($view);

            $content = $this->controller->{$this->actionName}();
            echo $content;
        } catch (RedirectException $e) {
            header('Location: ' . $e->gerUrl());
        } catch (RouteException $e) {
            header("HTTP/1.0 404 Not Found");
            echo $e->getMessage();
        }

    }

    private function addRoutes()
    {
//        /** @uses \App\Controller\User::loginAction() */ //чтобы можно было искать в find ussages (когда типо в классе находишься - можешь посмотреть, где используется + можно кликнуть по экшену
        $this->route->addRoute('/user/go', User::class, 'login'); //User::class - чтобы можно было кликнуть и искать в find ussages
//
//        /** @uses \App\Controller\User::registerAction() */
//        $this->route->addRoute('/user/register', \App\Controller\User::class, 'register');
//
//        /** @uses \App\Controller\Blog::indexAction() */
        $this->route->addRoute('/blog', \App\Controller\Blog::class, 'index');
//        $this->route->addRoute('/blog/index', \App\Controller\Blog::class, 'index');
    }

    private function initController()
    {
        $controllerName  = $this->route->getControllerName();
//        если нет класса контроллера с ведённым названием, то выбрасываем ошибку
        if (!class_exists($controllerName)) {
            throw new RouteException('Sir! Cant find controller' . $controllerName);
        }
        $this->controller = new $controllerName();
    }

    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if (!method_exists($this->controller, $actionName)) {
            throw new RouteException('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }
        $this->actionName = $actionName;
    }
}