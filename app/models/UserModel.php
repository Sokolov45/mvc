<?php
namespace app\models;

class UserModel
{

    private $name;
    private $id;
    private $dateOfRegister;
    private $email;
    private $password;

    //проверка авторизации


    //сохранение модели в базу данных
    public function register($name, $email, $password)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO mvc (`name`, email, password) VALUES (:name, :email, :password)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    function generateHash($password) {
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            return crypt($password, $salt);
        }
    }

    public static function checkName($name)
    {
        if (strlen($name) >= 2) return true;
        else return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 4) return true;
        else return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        else return false;
    }

    public static function checkUserEmail($email)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch();
        if ($user) return true;
        else return false;
    }

}