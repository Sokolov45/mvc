<?php
namespace Base;

class View  //будет заниматься рендеренгом (возвращать контент)
{
    private $templatePath = '';
    private $data = [];

    public function __construct()
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    /*короче у нас есть передача параметров через шаблон (метод render), нужно научиться просто передавать
    переменные*/
    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render(string $tpl, $data = []): string
    {
        $this->data += $data;   //массив + чё?
        ob_start();
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean();
    }

    /*магический метод - вызывается при обращении к несуществующему свойству класса
    нужен короче потому, что мы не знаем какие данные будет передавать контроллер (их же будет много и у них
    разные данные будут - заранее не угадаешь, поэтому и пользуем __get*/
    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }
}