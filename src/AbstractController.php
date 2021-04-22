<?php
namespace Base;

use App\Model\User;

abstract class AbstractController  //это наш базовый контроллер
{
//    Мы будем из контроллера указывать какой шаблон хотим отобразить и для этого пихаем туда вью
    /** @var View */
    protected $view;
    /** @var User */
    protected $user;    //сами с собой договариваемся, что храним здесь текущего атворизованного пользователя

    protected function redirect(string $url) //метод редиректа
    {
        throw new RedirectException($url);
    }

    /** @param View $view   */  /*так говорим шторму, что аргумент $view - это экземпляр класса View (передаётя
  объект класса View*/
    public function setView(View $view): void   /*будем пользовать в Application (записывать объект View контролеру,
        чтобы потом в его экшене вызывать View->render()*/
    {
        $this->view = $view;
    }

    /** @var User $user */  //здесь можно и без него, потому что мы в параметрах используем указание типов
 public function setUser(User $user): void
    {
        $this->user = $user;
    }
}