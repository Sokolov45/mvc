<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    function loginAction()
    {
        echo __METHOD__;
    }

    function registerAction()
    {
        $names = ['Dima', 'Bob', 'Anton', 'Jack'];
        $name = $names[array_rand($names)];   //ПОЛУЧИТЬ СЛУЧАЙНЫЙ КЛЮЧ а затем взять элемент
        $gender = UserModel::GENDER_MALE;
        $password = '12345';

//        инклудим namespace через алиас, чтобы не было конфликта имён
        $user = (new UserModel())
            ->setName($name)
            ->setGender($gender)
            ->setPassword(UserModel::getPasswordHash($password));

        $userId = $user->save();

        var_dump($user->getId());

        return $this->view->render('User/register.phtml', [
        ]);
    }

//    научимся получать пользователя из базы
    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }
}

