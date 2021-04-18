<?php
namespace App\Controller;
use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{

//    метода для авторизации
    public function loginAction()
    {
//        получаем от пользователя имя и пароль
        $name = $_POST['name'];
        $password = $_POST['password'];

//        теперь нужно получить пользователя с таким именем и паролем - нужен метод getByName

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

        $user->save();    //сохраняем пользователя

        $this->redirect('Blog/index');
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
