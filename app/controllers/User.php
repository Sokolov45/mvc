<?php
namespace controllers;
//use models\UserModel;
//require_once "../../vendor/autoload.php";

class User
{
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
                $checkLogin = User::checkUserLogin($login);
                if ($checkLogin == true) $errors[] = 'Пользователь с таким Логином, уже зарегистрирован, введите другой Логин';
                if ($checkEmail == true) $errors[] = 'Пользователь с таким E-mail, уже зарегистрирован, введите другой E-mail';
                else
                {0
                    $hashed_password = User::generateHash($password); // Сохраняем Хеш пароля
                    if (!User::register($login, $email, $hashed_password)) $errors[] = 'Ошибка Базы Данных';
                }
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/user/register.php');
//        return true;
    }

    public function authorizationAction()
    {
        echo 'здесь выведем форму авторизации';
//        include "../templates/User/authorization.phtml";
    }

}