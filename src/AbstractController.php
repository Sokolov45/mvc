<?php
namespace Base;

abstract class AbstractController  //это наш базовый контроллер
{
//    Мы будем из контроллера указывать какой шаблон хотим отобразить и для этого пихаем туда вью
    /** @var View */
    protected $view;
    protected function redirect(string $url) //метод редиректа
    {
        throw new RedirectException($url);
    }

    /**
     * @param View $view
     */
    public function setView(View $view): void   //будем пользовать в Application (записывать объект View контролеру,
//        чтобы потом в его экшене вызывать View->render()
    {
        $this->view = $view;
    }
}