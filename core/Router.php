<?php
namespace core;
use controllers\User;
require_once "../vendor/autoload.php";


class Router
{
    private $controllerName = '';
    private $actionName = '';

    public function getRoute()
    {
        $requestFromUser = new Request();
        $this->controllerName = $requestFromUser->getControllerName();
        $this->actionName = $requestFromUser->getActionName();
        $this->controllerName = ucfirst(strtolower($this->controllerName));
        $this->actionName = ucfirst(strtolower($this->actionName));
    }

    public function goRoute() {
        $this->getRoute();
        $controllerFileName = $this->getControllerName();
        $actionFuncName =  $this->getActionName();

//        понимает new User, но не понимает через new $controllerFileName();
//        var_dump($controllerFileName);
//        $controllerObj = new User();
        $controllerObj = new $controllerFileName();
        $controllerObj->$actionFuncName();
    }


    public function verificationOfAuthorization()
    {
        if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
//            include "../app/templates/authorization.phtml";
        }else{
//            echo "вы зарегистрировались";
        }
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        return $this->actionName . 'Action';
    }
}
