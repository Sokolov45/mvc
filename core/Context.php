<?php
namespace Core;

class Context
{
    private static $_instance;

    private $_request;
    private $_dispatcher;
    private $_db;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function i()
    {
        if(!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getRequest(): Request
    {
        return $this->_request;
    }


    public function setRequest(Request $request): void
    {
        $this->_request = $request;
    }


    public function getDispatcher(): Dispatcher
    {
        return $this->_dispatcher;
    }


    public function setDispatcher(Dispatcher $dispatcher): void
    {
        $this->_dispatcher = $dispatcher;
    }


    public function getDb(): DB
    {
        return $this->_db;
    }


    public function setDb(DB $db): void
    {
        $this->_db = $db;
    }

}