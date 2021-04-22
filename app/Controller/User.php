<?php
namespace App\Controller;
use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    /*РАССУЖДЕНИЯ: У нас есть метод, который логинит юзера, который регистрирует юзера и нам нужен
    ещё метод, который будет отоброжать страницу с формой ввода логина и пароля. Тут у нас Дима будет
    делать так, что loginAction будет работать и как для самого активного действия (авторизации) если переда верно логин
    и пароль, а также для отображения формы (если не передано имя). Так типо будет удобно передавать ошибку. То есть один и тот же метод
    - мы просто в шаблон прокинем в 2 случаях ( if (!$user).. и  if (UserModel::getPass...) нашу ошибку
    и сможем там её вывести.
    Если бы это было 2 разных метода (отдельно логинформ например), то пришлось бы делать редирект на логинформ. Как
    должно работать: чел попадает на форму регистрации-авторизации, вводит неверно логин-пароль, его должно перекинуть
    назад на форму, но надо должно передать сообщение, что вы ввели неверно и типо между 2 разными экшенами сложно пере-
    давать (пришлось бы передавать какой-то код ошики через URL) проще сделать на основе одного экшена.
    */

    //метода для авторизации
    public function loginAction()
    {
        //получаем от пользователя имя (оно у нас сделано уникальным)
        $name = trim($_POST['name']);

        if ($_POST['name']) {    //если имя передано, то мы начинаем пытаться авторизовать юзера
            $password = $_POST['password'];
            /*    теперь нужно получить пользователя с таким именем и паролем - нужен метод getByName*/
            $user = UserModel::getByName($name);
            if (!$user) {
                $this->view->assign('error', 'Неверный логин и пароль');
            }

            if ($user) {
                if (UserModel::getPasswordHash($password) != $user->getPassword()) {
                    $this->view->assign('error', 'Неверный логин и пароль');
                } else {
                    //если пользователь успешно авторизовался - помещаем идентификатор пользователя в сессию
                    $_SESSION['id'] = $user->getId();
                    $this->redirect('blog/index');
                }
            }
        }

//        Нам нужно отрендерить шаблон регистрации
        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int) $_GET['id']), /*Здесь мы получаем пользователя и
             одновременно создаём объект c полученными из базы данными*/
            "Anton" => 'Sokol'
        ]);
    }

    function registerAction()   //экшен для "зарегистрировать пользователя"
    {
        $name = trim($_POST['name']);
        $gender = UserModel::GENDER_MALE;
        $password = trim($_POST['password']);

        $success = true;

        if (isset($_POST['name'])) {
            //        Проверяем переданы ли имя и пароль
            if (!$name) {
                $this->view->assign('error', 'Имя не может быть пустым');
                $success = false;
            }

            if (!$password) {
                $this->view->assign('error', 'Пароль не может быть пустым');
                $success = false;
            }

            $user = UserModel::getByName($name);
            if ($user) {
                $this->view->assign('error', 'Пользователь с таким именем уже существует');
                $success = false;
            }

            if($success) {
                $user = (new UserModel())   //инклудим namespace через алиас, чтобы не было конфликта имён
                ->setName($name)
                    ->setGender($gender)
                    ->setPassword(UserModel::getPasswordHash($password));

                $user->save();    //сохраняем пользователя

                /*если мы зарегились, то надо авторизовать пользователя (как будто он зашёл на сайт*/
                $_SESSION['id'] = $user->getId();   //добавляем id в сессию
                $this->setUser($user);  /*засетить пользователя в наш контроллер (чтобы мы могли проверять
                через $this->user если вдруг мы где-то захотим ещё где-то модельку $this->user использовать
                Конкретно здесь это не так важно, потому что редирект делаем, но если бы вместо редиректа была
                какая-то логика, то в ней хорошо чтобы $this->user работал */

                $this->redirect('/blog/index');
            }
        };

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int) $_GET['id']), /*Здесь мы получаем пользователя и
             одновременно создаём объект c полученными из базы данными*/
            "Anton" => 'Sokol'
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

    public function logoutAction()
    {
        session_destroy();
        $this->redirect('/user/login');  //редиректим на страницу логина пароля
    }

}
