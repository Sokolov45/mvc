<?php
namespace Base;

use App\Model\User;

abstract class AbstractController  //это наш базовый контроллер
{
//    Мы будем из контроллера указывать какой шаблон хотим отобразить и для этого пихаем туда вью
    /** @var View */
    protected $view;
    /** @var User */
    protected $user;

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

    /** @var User $user */
 public function setUser(User $user): void   //будем пользовать в Application (записывать объект View контролеру,
//        чтобы потом в его экшене вызывать View->render()
    {
        $this->user = $user;
    }
}