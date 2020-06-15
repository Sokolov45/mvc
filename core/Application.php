<?php
namespace core;
use controllers\User;
require_once "../vendor/autoload.php";


class Application
{

    public function run()
    {
        $router = new Router();
        $router->goRoute();
    }
}



//if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
//    echo $_SESSION["error_messages"];
//
//    //Уничтожаем чтобы не выводились заново при обновлении страницы
//    unset($_SESSION["error_messages"]);
//}
