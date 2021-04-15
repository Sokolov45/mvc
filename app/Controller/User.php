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

    function registerAction()   //экшен для "зарегистрировать пользователя"
    {
//        здесь получаем данные для создания пользователя - но почему здесь то, а не в модели????????
        $names = ['Dima', 'Bob', 'Anton', 'Jack'];
        $name = $names[array_rand($names)];   //ПОЛУЧИТЬ СЛУЧАЙНЫЙ КЛЮЧ а затем взять элемент
        $gender = UserModel::GENDER_MALE;
        $password = '12345';
        $user = (new UserModel())   //инклудим namespace через алиас, чтобы не было конфликта имён
            ->setName($name)
            ->setGender($gender)
            ->setPassword(UserModel::getPasswordHash($password));

        $userId = $user->save();    //сохраняем пользователя

        var_dump($user->getId());

        return $this->view->render('User/register.phtml', [
        ]);
    }

//    научимся получать пользователя из базы
    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
            'user' => UserModel::getById((int) $_GET['id']), /*Здесь мы получаем пользователя и
             одновременно создаём объект c полученными из базы данными*/
            "Anton" => 'Sokol'
        ]);
    }
}
