<?php
//это назвается исполняемый файл

use Base\Route;
use Base\RouteException;

include "../vendor/autoload.php";

$parts = parse_url($_SERVER['REQUEST_URI']);

/*Выносим всю логику роутинга внутрь объекта Route, в индексе оставляем только добавление статических(тех, которые
 указываем напрямую) роутов*/
$route = new Route();
/** @uses \App\Controller\User::loginAction() */ //чтобы можно было искать в find ussages + можно кликнуть по экшену
$route->addRoute('/user/login', \App\Controller\User::class, 'login'); //User::class - чтобы можно было кликнуть
/** @uses \App\Controller\User::registerAction() */
$route->addRoute('/user/register', \App\Controller\User::class, 'register');
/** @uses \App\Controller\Blog::indexAction() */
$route->addRoute('/blog', \App\Controller\Blog::class, 'index');
$route->addRoute('/blog/index', \App\Controller\Blog::class, 'index');

$controllerName  = $route->getControllerName();
$controller = new $controllerName;

$actionName = $route->getActionName();
if (!method_exists($controller, $actionName)) {
    throw new RouteException('Action ' . $actionName . ' not found in ' . $controllerName);
}

$controller->$actionName();