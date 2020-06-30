<?php
namespace core;
require_once "../vendor/autoload.php";
class Application
{
    public function run()
    {
        session_start();
        if (!isset($_SESSION["user_ID"]) &&  $_SERVER['REQUEST_URI'] != '/user/register') {
//            header("Location: user/authorization");
            include "../app/templates/User/authorization.phtml";
            exit();
        } else {
            $router = new Router();
            $router->getRoute();
            $actionFuncName = $router->getActionFuncName();
            $controllerFileName = $router->controllerFileName();
            $actionName = $router->getActionName();

            $controllerObj = 'app\controller\\' . $controllerFileName;
            $controllerObj = new $controllerObj();
            $tpl = "../app/templates/" . $controllerFileName . '/' . $actionName . '.phtml';
            var_dump($actionFuncName);
            $view = new View();
            $controllerObj->view = $view;
            $controllerObj->$actionFuncName();
            $view->render($tpl);
            echo $view->render($tpl);
        }


  //        if (isset($_POST['login']) && isset($_POST['password']))
//        {
//// получаем данные из формы с авторизацией
//            $login = mysql_real_escape_string($_POST['login']);
//            $password = $_POST['password'];
////проверка пароля и логина
//            if (($login=='a123')&& ($password=='123')){
//                echo ("логин совпадает и пароль верны");
//                $_SESSION['Name']=$login;
//// идем на страницу для авторизованного пользователя
//                header("Location: /author/sekret.php");
//            }
//            else
//            {die('Такой логин с паролем не найдены в базе данных.');
//            }
//        }
//

//        if (!method_exists($controllerObj, $actionFuncName)) {
//            echo "такого экшена нет";
//            die;}
//



    }
}








