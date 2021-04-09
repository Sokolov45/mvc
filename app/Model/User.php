<?php
namespace App\Model;

use Base\AbstractModel;


//модель пользователя будет описывать то, что мы храним в базе данных
class User extends AbstractModel
{
    public function getName()
    {
        return 'Anton';
    }
}