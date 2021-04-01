<?php
namespace Base;

abstract class AbstractController  //это наш базовый контроллер
{
    protected function redirect(string $url) //метод редиректа
    {
        throw new RedirectException($url);
    }
}