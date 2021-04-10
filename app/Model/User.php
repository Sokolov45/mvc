<?php
namespace App\Model;

use Base\AbstractModel;
use Base\Db;


//модель пользователя будет описывать то, что мы храним в базе данных
class User extends AbstractModel
{
//константы под гендер
    const GENDER_FEMALE = 2;
    const GENDER_MALE = 1;


//    делаем свойства такие же как название колонки в бд
    private $id;
    private $name;
    private $password;
    private $createdAt;
    private $gender;

    public function __construct($data = [])
    {
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->password = $data['password'];
            $this->gender = $data['gender'];
            $this->createdAt = $data['created_at'];
        }
    }

    //    делаем геттеры и сеттеры для всех наших полей
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    public function getGenderString(): string
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    /**
     * @param mixed $gender
     */
    public function setGender(int $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

//    сохранить пользователя
    public function save()
    {
//        получаем объект соединения с базой данных
        $db = Db::getInstance();
//        запрос
        $insert = "INSERT INTO users (`name`, `password`, `gender`) VALUES (
            :name, :password, :gender
        )";
        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':password' => $this->password,
            ':gender' => $this->getGender()
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;
        return $id;
    }

    public static function getById(int $id): ?self  //?self - вернеёт либо объект этого класса либо нал
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            return null;
        }

/*      можно так:
        $model = new self();
        $model->id = $data['id'];
        $model->password = $data['password'];
        $model->gender = $data['gender'];
        $model->createdAt = $data['created_at'];
        return $model;
*/

//        а можно проще сделать вот такой ретурн и добавить в конструктор данные:
        return new self($data);

    }

    //        статический потому, что к самой модельке отношения не имеет
    public static function getPasswordHash(string $password)
    {
        return sha1(',asdf,31!' . $password);
    }

}

/*логика такая: создаём модельку пользователя (это всё происходит в памяти php), затем отправляем запрос в базу
база делает инсерт - возвращает индетификатор записи и мы помещяем его в модель на случай если потом захотим воспользоваться
(в контроллере например можем сделать $user->getId())*/