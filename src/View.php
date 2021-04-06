<?php
namespace Base;

class View  //будет заниматься рендеренгом
{
    private $templatePath = '';
    private $data = [];


    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function render(string $tpl, $data = []): string
    {
        $this->data += $data;
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean();
    }
    public function __get($varName) //магический метод - вызывается при обращении к несуществующему свойству класса
    {
        return $this->data[$varName] ?? null;
    }
}