<?php
namespace App\Controller;

use Base\AbstractController;

class User extends AbstractController
{
    function loginAction()
    {
        echo __METHOD__;
    }

    function registerAction()
    {
        $user = new \App\Model\User();
        return $this->view->render('User/register.phtml', [
            'userName' => 'Anton',
            'age' => 18,
            'user' => $user]);
    }
}