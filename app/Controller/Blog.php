<?php
namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class Blog extends AbstractController
{
    function indexAction()
    {
        if (!$this->user) {
            $this->redirect("/user/register");
        }

//        /*если захотим что-то делать от мени пользователя (например отправлять сообщение в блог)*/
//        $message = new Message(); //создали бы объект
//        $message->setUserId($this->user->getId());  /*сделали бы метод - передали бы id и так бы связали бы
//        сообщение с пользователем*/

        return $this->view->render('Blog/index.phtml', [
            'user' => $this->user
        ]);

        echo 'Вы вошли как ' . $this->user->getName();
    }
}