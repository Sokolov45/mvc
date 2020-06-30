<?php
namespace core;

class Request
{
    private $_controllerName = '';
    private $_actionName = '';

    public function __construct()
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);
        $this->_controllerName = $parts[1] ?? '';
        $this->_actionName = $parts[2] ?? '';
    }

      public function getControllerName(): string
    {
        return $this->_controllerName;
    }

        public function getActionName(): string
    {
        return $this->_actionName;
    }
}
