<?php
namespace core;

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
//        $this->actionName = ucfirst(strtolower($this->actionName));
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
