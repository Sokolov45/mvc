<?php
namespace App\Model;

use Base\AbstractModel;


//модель пользователя будет описывать то, что мы храним в базе данных
class User extends AbstractModel
{
//константы под гендер
    const GENDER_FEMALE = 2;
    const GENDER_MALE = 1;


//    делаем свойства такие же как колонки в бд
    private $id;
    private $name;
    private $password;
    private $createdAt;
    private $gender;

    public function getName()
    {
        return 'Anton';
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
    public function setId($id): void
    {
        $this->id = $id;
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
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

//    делаем геттеры и сеттеры для всех наших полей

}