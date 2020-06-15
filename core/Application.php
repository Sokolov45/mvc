<?php
namespace core;
//use controller\User;
//include "../app/controller/User.php";
require_once "../vendor/autoload.php";

class Application
{
    public function run()
    {
        $router = new Router();

//        $a = new User();
//        $a->authorizationAction();
//        var_dump($a);
        $router->getRoute();
        $controllerFileName = $router->getControllerName();
        $actionFuncName =  $router->getActionName();
//        include "../app/controller/$controllerFileName.php";
//        $controllerObj = new $controllerFileName();
//        var_dump($controllerObj);
        $controllerObj = new User();
//
//        var_dump($actionFuncName);

    }
}



//if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
//    echo $_SESSION["error_messages"];
//
//    //Уничтожаем чтобы не выводились заново при обновлении страницы
//    unset($_SESSION["error_messages"]);
//}
