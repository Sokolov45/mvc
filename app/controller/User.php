<?php
namespace app\controller;
class User
{
//    сюда запихиваем объект вью
    public $view;

    public function registerFormAction()
    {
        $name = false;
        $email = false;
        $password = false;

        // Обработка формы
        if (isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!UserModel::checkPassword($password)) $errors[] = 'Вы не ввели пароль, пароль меньше 6-х символов';
            if (!User::checkName($name)) $errors[] = 'Логин меньше 3-х символов';
            if (!User::checkEmail($email)) $errors[] = 'Не верно указан E-mail';
            else
            {
                // Проверяем существует ли пользователь
                $checkEmail = User::checkUserEmail($email);


                if ($checkEmail == true) $errors[] = 'Пользователь с таким E-mail, уже зарегистрирован, введите другой E-mail';
                else
                {
                    $hashed_password = User::generateHash($password); // Сохраняем Хеш пароля
                    if (!User::register($email, $hashed_password)) $errors[] = 'Ошибка Базы Данных';
                }
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/user/register.php');
//        return true;
    }

    public function authorizationAction()
    {
        $this->view->var = 'это я запихивал в вью контроллера';
    }

}