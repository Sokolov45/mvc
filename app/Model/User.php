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

    /* Вообщем мы создаём объект в СТАТИЧЕСКОМ (Объявление свойств и методов класса статическими
    позволяет обращаться к ним без создания экземпляра класса) методе getById() этого же класса, то есть по сути создаём
    объект класса из его же собственного метода, благодаря тому, что это метод статический. Мы передам методу id,
    он ищет пользователя по этому id и записывает его в переменную в виде массива, после чего создаёт объект этого же
    класса передавая в параметры массив пользователя...а! как тебе такое!?)  */
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
     * @return User
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

//    создать объект класса и сразу записать в него полученные из базы свойства (id, gender и тд)
    public static function getById(int $id): ?self  //?self - вернеёт либо объект этого же класса либо нал
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);
        if (!$data) {
            return null;
        }
        return new self($data);
    }

//    получаем модельку пользователя по имени
    public static function getByName(string $name): ?self    //В данном контексте предполагается, что имя должно быть уникальным
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name
        ]);
        if (!$data) {
            return null;
        }
        return new self($data);
    }

    public function save()  //сохранить пользователя
    {
        $db = Db::getInstance();    //получаем объект соединения с базой данных
        $insert = "INSERT INTO users (`name`, `password`, `gender`) VALUES (
            :name, :password, :gender
        )";
        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':password' => $this->password,
            ':gender' => $this->gender
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;    //записываем только что полученный идентификатор в модель пользователя
        return $id;
    }

    public static function getPasswordHash(string $password)  //статический потому, что к самой модельке отношения не имеет
    {
        return sha1(',asdf,31!' . $password);
    }
}

/*логика такая: создаём модельку пользователя (это всё происходит в памяти php), затем отправляем запрос в базу
база делает инсерт - возвращает индентификатор записи и мы помещяем его в модель на случай если потом захотим
воспользоваться (в контроллере например можем сделать $user->getId())*/