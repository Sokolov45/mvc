<?php
//это назвается исполняемый файл

use Base\Route;
use Base\RouteException;

include "../vendor/autoload.php";

$parts = parse_url($_SERVER['REQUEST_URI']);

/*Выносим всю логику роутинга внутрь объекта Route, в индексе оставляем только добавление статических(тех, которые
 указываем напрямую) роутов*/
$route = new Route();
/** @uses \App\Controller\User::loginAction() */ //чтобы можно было искать в find ussages (когда типо в классе находишься - можешь посмотреть, где используется + можно кликнуть по экшену
$route->addRoute('/user/login', \App\Controller\User::class, 'login'); //User::class - чтобы можно было кликнуть и искать в find ussages

/** @uses \App\Controller\User::registerAction() */
$route->addRoute('/user/register', \App\Controller\User::class, 'register');

/** @uses \App\Controller\Blog::indexAction() */
$route->addRoute('/blog', \App\Controller\Blog::class, 'index');
$route->addRoute('/blog/index', \App\Controller\Blog::class, 'index');

$controllerName  = $route->getControllerName();
var_dump($controllerName);
$controller = new $controllerName;

$actionName = $route->getActionName();
if (!method_exists($controller, $actionName)) {
    throw new RouteException('Action ' . $actionName . ' not found in ' . $controllerName);
}

$controller->$actionName();


/*непонятки
1. User::class - нахуа ::class ?    Ответ:
Ключевое слово class используется для разрешения имени класса. Чтобы получить полное имя класса ClassName::class,
 используйте ClassName::class. Обычно это довольно полезно при работе с классами, использующими пространства имён.
Пример #14 Разрешение имени класса
<?php
namespace NS {
    class ClassName {
    }
    echo ClassName::class;
}
?>
Результат выполнения данного примера:
NS\ClassName
или
use \App\Console\Commands\Inspire;
//...
protected $commands = [
    Inspire::class, // Equivalent to "App\Console\Commands\Inspire"
];

2. поему в addRoute передается экшн с маленькой буквы?

3. зачем создавать RouteException?

4. $controller->$actionName(); это че
*/