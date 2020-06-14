<?php
namespace core;

class View
{
    protected $data;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;

    }

    public function __get($name)
    {
        if (isset($this->_data[$name])) {
            return $this->data[$name];
        }
        return '';
    }


    public function render(string $tpl)
    {
        ob_start();
        include $tpl;
        ob_get_clean();
    }
}