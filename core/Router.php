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

        $this->actionName = $this->actionName;
    }

    public function controllerFileName(): string
    {
        $this->controllerName = ucfirst(strtolower($this->controllerName));
        return $this->controllerName;
    }

    public function getActionFuncName(): string
    {
        return $this->actionName . 'Action';
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }
}
