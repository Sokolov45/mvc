<?php
namespace core;

class Application
{
    public function run()
    {
        $router = new Router();
        $router->verificationOfAuthorization();



//        include "../app/views/registerForm.html";
    }


}







//if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
//    echo $_SESSION["error_messages"];
//
//    //Уничтожаем чтобы не выводились заново при обновлении страницы
//    unset($_SESSION["error_messages"]);
//}
//
////Если в сессии существуют радостные сообщения, то выводим их
//if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
//    echo $_SESSION["success_messages"];
//
//    //Уничтожаем чтобы не выводились заново при обновлении страницы
//    unset($_SESSION["success_messages"]);
//}