<?php
namespace Base;

class RedirectException extends \Exception  /*Это сделано для: "Никогда не бросайте абстрактное исключение (т.е. просто
 Exception). Объявите хотя бы один класс исключений специально для вашего приложения (модуля, библиотеки). И везде
заменить throw new Exception(); на throw new baseException();
Таким образом, все исключения вашего кода можно будет отличить от исключений не вашего кода."*/

{
    private $url; //куда мы редиректим
    public function __construct(string $url)
    {
        $this->url = $url;
    }
    public function gerUrl(): string
    {
        return $this->url;
    }
}

//пользовать его будет в AbstractController